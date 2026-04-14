<?php

namespace App\Http\Controllers\Web\Backend\V1\Agent;

use App\Http\Controllers\Controller;
use App\Mail\AgentApproved;
use App\Models\Agent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            $data = Agent::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('properties_managed_count', function ($row) {
                    return (int) ($row->properties_managed_count ?? 0);
                })
                ->addColumn('date', function ($row) {
                    return optional($row->created_at)->format('d M Y') ?: 'N/A';
                })
                ->editColumn('status', function ($row) {
                    return $row->status;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('manage-agents.edit', $row->id) . '" class="btn btn-sm btn-outline-primary" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['status', 'action'])
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
            return view('backend.layouts.agentManagement.show', compact('agent'));
        } catch (Exception $e) {
            return redirect()->route('manage-agents.index')->with('t-error', 'Agent not found');
        }
    }
}
