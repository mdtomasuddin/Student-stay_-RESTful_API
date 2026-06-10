<?php

namespace App\Http\Controllers\Web\Backend\V1\StudentEnquiries;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\StudentEnquirie;
use Carbon\Carbon;
use Exception;
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
                ->editColumn('full_name', function ($row) {
                    return !empty($row->full_name) ? $row->full_name : 'N/A';
                })
                ->editColumn('phone', function ($row) {
                    return !empty($row->phone) ? $row->phone : 'N/A';
                })
                ->addColumn('message', function ($row) {
                    if (empty($row->message)) return 'N/A';
                    return strlen($row->message) > 50 ? substr($row->message, 0, 50) . '...' : $row->message;
                })
                ->editColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? Carbon::parse($row->created_at)->format('d M, Y H:i A') : 'N/A';
                })
                ->addColumn('prefered_move_in_date', function ($row) {
                    return !empty($row->preferred_move_in_date) ? Carbon::parse($row->preferred_move_in_date)->format('d M, Y') : 'N/A';
                })
                ->editColumn('email', function ($row) {
                    return !empty($row->email) ? '<a href="mailto:' . $row->email . '" class="text-primary fw-medium">' . $row->email . '</a>' : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="showEnquiryDetails(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#viewEnquiryModal">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-outline-danger" title="Delete">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>';
                })

                ->rawColumns(['message', 'created_at', 'prefered_move_in_date', 'email', 'action'])
                ->make(true);
        }

        return view('backend.layouts.studentEnquirie.index');
    }

    /**
     * Show Enquiry Details
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $enquiry = StudentEnquirie::findOrFail($id);
            return response()->json(['success' => true, 'data' => $enquiry]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Enquiry not found.']);
        }
    }

    /**
     * Delete Enquiry
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $enquiry = StudentEnquirie::findOrFail($id);
            $enquiry->delete();
            return response()->json(['t-success' => true, 'message' => 'Enquiry deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['t-success' => false, 'message' => 'Something went wrong!']);
        }
    }
}
