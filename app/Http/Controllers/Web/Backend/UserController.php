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
            $data = User::where('role', $userType)->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('avatar', function ($data) {
                    return '<img src="' . asset($data->avatar ?? 'backend/admin/assets/images/avatar_defult.png') . '" class="wh-40 rounded-3" alt="no image found">';
                })
                ->addColumn('status', function ($data) {
                    $status = '<div class="form-check form-switch">';
                    $status .= '<input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;width:40px"' . $data->id . '" name="status"';

                    if ($data->status == "active") {
                        $status .= ' checked';
                    }

                    $status .= '>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper">
                        <a type="button" href="javascript:void(0)"
                                class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
                                data-bs-toggle="modal" data-bs-target="#ShowUser" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-primary">visibility</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger"><i class="bi bi-trash"></i></i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['avatar', 'status', 'action'])
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
        $data = User::with('services','bookings')->findOrFail($id);
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
        // delete the 
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
