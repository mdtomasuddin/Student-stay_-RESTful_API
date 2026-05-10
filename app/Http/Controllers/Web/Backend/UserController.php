<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the units with DataTables support.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::where('role', 'user')->latest();


            //datatable response
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone ?? '<span class="text-muted">N/A</span>';
                })
                ->editColumn('email', function ($row) {
                    return '<a href="mailto:' . $row->email . '" class="text-primary fw-medium">' . $row->email . '</a>';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y');
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('users.show', $row->id) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['email', 'phone', 'action', 'name'])
                ->make(true);
        }
        return view("backend.layouts.user.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::findOrFail($id);
        return view("backend.layouts.user.show", compact("data"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        // check if the  exists
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }
        // prevent deletion of agent or other protected roles
        if ($data->role !== 'user') {
            return response()->json([
                "success" => false,
                "message" => "This account cannot be deleted."
            ], 403);
        }

        // delete the image if present
        if (!empty($data->image)) {
            Helper::fileDelete(public_path($data->image));
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function status(Request $request, $id)
    {
        $data = User::find($id);

        // check if the  exists
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        // toggle status of the 
        if ($data->status == 'active') {
            $data->status = 'inactive';
        } else {
            $data->status = 'active';
        }

        // save the changes
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
    }
}
