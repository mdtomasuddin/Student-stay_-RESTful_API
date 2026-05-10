<?php

namespace App\Http\Controllers\Web\Backend\V1\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PropertyManageController extends Controller
{
    /**
     * Retrieve all properties with optional search and pagination
     *property list show function and ajax data table and status change
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Property::with(['category', 'city', 'user'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image = $row->images[0] ?? asset('backend/images/users/avatar-1.jpg');
                    return '<img src="' . $image . '" alt="Property" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">';
                })
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->first_name . ' ' . $row->user->last_name : '<span class="text-danger">N/A</span>';
                })
                ->addColumn('title', function ($data) {
                    return Str::limit($data->title, 25, '...');
                })
                ->addColumn('description', function ($data) {
                    return Str::limit($data->description, 30, '...');
                })

                ->addColumn('status', function ($row) {
                    return $row->status;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('manage-properties.edit', $row->id) . '" class="btn btn-sm btn-outline-primary" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-outline-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['image', 'title', 'description', 'status', 'user', 'action'])->make(true);
        }

        return view('backend.layouts.properties.manageProperties.index');
    }

    /**
     * Update the status of the specified property
     *
     * @return JsonResponse
     *status change function
     *
     * @throws HttpResponseException
     */
    public function updateStatus(Request $request)
    {
        try {
            $property         = Property::findOrFail($request->id);
            $property->status = $request->status;
            $property->save();

            return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to update status'], 500);
        }
    }

    /**
     * Edit property
     *
     * @param  int  $id
     * @return Response
     *
     * @throws ModelNotFoundException
     *                                PropertyManageController all info show  this function
     */
    public function edit($id)
    {
        try {
            $property = Property::with(['category', 'city', 'user', 'universities', 'roomListings'])->findOrFail($id);

            return view('backend.layouts.properties.manageProperties.show', compact('property'));
        } catch (Exception $e) {
            return redirect()->route('manage-properties.index')->with('t-error', 'Property not found');
        }
    }

    /**
     * Delete property
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $property = Property::findOrFail($id);
            $property->delete();

            return response()->json([
                'success' => true,
                'message' => 'Property deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete property.',
            ], 500);
        }
    }
}
