<?php

namespace App\Http\Controllers\Web\Backend\V1\Agent;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\AgentApproved;
use App\Models\Agent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\RoomListing;
use Yajra\DataTables\DataTables;

class AgentMangementController extends Controller
{
    /**
     * Index of Agent Management
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agent::query()
                ->latest('id')
                ->select('agents.*')
                ->selectSub(
                    DB::table('users')
                        ->join('properties', 'properties.user_id', '=', 'users.id')
                        ->whereColumn('users.email', 'agents.email')
                        ->selectRaw('COUNT(properties.id)'),
                    'current_managed_properties_count'
                );
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('properties_managed_count', function ($row) {
                    return (int) ($row->properties_managed_count ?? 0);
                })
                ->addColumn('current_managed_properties_count', function ($row) {
                    return (int) ($row->current_managed_properties_count ?? 0);
                })
                ->addColumn('date', function ($row) {
                    return optional($row->created_at)->format('d M Y') ?: 'N/A';
                })
                ->editColumn('status', function ($row) {
                    return $row->status;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('manage-agents.edit', $row->id) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['status', 'properties_managed_count', 'current_managed_properties_count', 'action'])
                ->make(true);
        }
        return view('backend.layouts.agentManagement.index');
    }

    /**
     * Update the status of the agent and create a user account upon approval.
     * * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:approved,pending,rejected,cancelled,verified',
            ]);
            $agent         = Agent::findOrFail($id);
            $status        = $request->status;
            $agent->status = $status;
            $agent->save();

            // Create user account upon approval
            if ($status === 'approved') {
                $user          = User::where('email', $agent->email)->first();
                $plainPassword = '12345678';

                if ($user) {
                    $user->update(['role' => 'agent']);
                    Mail::to($agent->email)->send(new AgentApproved($agent, 'Existing Password'));
                } else {
                    $user = User::create([
                        'first_name'           => $agent->full_name,
                        'last_name'            => null,
                        'email'                => $agent->email,
                        'email_verified_at'    => now(),
                        'password'             => Hash::make($plainPassword), // Fixed variable
                        'terms_and_conditions' => true,
                        'role'                 => 'agent',
                        'referral_code'        => null,
                    ]);
                    // Send email to agent with password agentApproved
                    Mail::to($agent->email)->send(new AgentApproved($agent, $plainPassword));
                }
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Agent status updated to ' . $status,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to update status: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Edit an agent
     * @package App\Http\Controllers\Web\Backend\V1\Agent
     * @subpackage AgentManageController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $agent = Agent::with(['city'])->findOrFail($id);
            $agentUser = User::where('email', $agent->email)->first();
            $agentProperties = collect();

            if ($agentUser) {
                $agentProperties = Property::where('user_id', $agentUser->id)->latest('id')->get();
            }

            return view('backend.layouts.agentManagement.show', compact('agent', 'agentProperties'));
        } catch (Exception $e) {
            return redirect()->route('manage-agents.index')->with('t-error', 'Agent not found');
        }
    }

    /**
     * Delete an agent
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $agent = Agent::findOrFail($id);

            // Delete the agent
            $agent->delete();

            // Delete the associated user by email if exists
            $user = User::where('email', $agent->email)->first();
            if ($user) {
                // Delete all properties owned by this user
                $properties = Property::where('user_id', $user->id)->get();
                foreach ($properties as $property) {
                    // Delete property images
                    if ($property->images && is_array($property->images)) {
                        foreach ($property->images as $image) {
                            $filePath = ltrim(parse_url($image, PHP_URL_PATH), '/');
                            Helper::fileDelete($filePath);
                        }
                    }

                    // Delete room listings and their images
                    $roomListings = RoomListing::where('property_id', $property->id)->get();
                    foreach ($roomListings as $roomListing) {
                        if ($roomListing->images && is_array($roomListing->images)) {
                            foreach ($roomListing->images as $image) {
                                $filePath = ltrim(parse_url($image, PHP_URL_PATH), '/');
                                Helper::fileDelete($filePath);
                            }
                        }
                    }

                    // Force delete all room listings (to handle soft deletes)
                    RoomListing::where('property_id', $property->id)->forceDelete();

                    // Delete property_university pivot records
                    DB::table('property_university')->where('property_id', $property->id)->delete();

                    // Delete the property
                    $property->delete();
                }

                // Delete the user
                $user->delete();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Agent deleted successfully.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete agent.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
