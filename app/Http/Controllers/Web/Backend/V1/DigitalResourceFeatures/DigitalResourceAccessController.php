<?php
namespace App\Http\Controllers\Web\Backend\V1\DigitalResourceFeatures;

use App\Http\Controllers\Controller;
use App\Models\DigitalResourceAccess;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DigitalResourceAccessController extends Controller
{

    /**
     * Display a listing of the resource.
     * This function is used to display the list of digital resources access in the backend.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DigitalResourceAccess::with(['user', 'digital_resource'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row->user ? $row->user->first_name . ' ' . $row->user->last_name : 'N/A';
                })
                ->addColumn('user_email', function ($row) {
                    return $row->user ? $row->user->email : 'N/A';
                })
                ->addColumn('resource_name', function ($row) {
                    return $row->digital_resource ? $row->digital_resource->title : 'ID: ' . $row->digital_resource_id;
                })
                ->rawColumns(['user_name', 'user_email', 'resource_name'])
                ->make(true);
        }

        return view('backend.layouts.digital-resources.DigitalResourceAccess.index');
    }
}
