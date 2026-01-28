<?php

namespace App\Http\Controllers\Web\Backend\V1\StudentEnquiries;

use App\Http\Controllers\Controller;
use App\Models\StudentEnquirie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentEnquiriesController extends Controller
{

    /**
     * Students Enquiries List View
     * Return student enquiries data in datatables format.
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTables
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentEnquirie::latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('message', function ($row) {
                    return strlen($row->message) > 50 ? substr($row->message, 0, 50) . '...' : $row->message;
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M, Y H:i A');
                })
                ->addColumn('prefered_move_in_date', function ($row) {
                    return $row->preferred_move_in_date ? Carbon::parse($row->preferred_move_in_date)->format('d M, Y') : 'N/A';
                })
                ->editColumn('email', function ($row) {
                    return '<a href="mailto:' . $row->email . '" class="text-primary fw-medium">' . $row->email . '</a>';
                })
                ->rawColumns(['message', 'created_at', 'prefered_move_in_date', 'email'])
                ->make(true);
        }

        return view('backend.layouts.studentEnquirie.index');
    }
}
