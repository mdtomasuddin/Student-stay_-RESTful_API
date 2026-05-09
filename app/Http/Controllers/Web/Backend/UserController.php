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
        $userType = $request->userType;
        // dd($userType);

        if ($request->ajax()) {
            // Always show only records with role = 'user'
            $data = User::where('role', 'user')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('users.show', $row->id) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("backend.layouts.user.index", compact("userType"));
    }
    /**
     * Show the form for creating a new data.
     */
    public function create()
    {
        flash()->warning('not found this page');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        flash()->warning('not found this page');
        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Load only basic user information to avoid undefined relationship errors
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
