<?php

namespace App\Http\Controllers\Web\Backend\V1\Property;

use App\Http\Controllers\Controller;
use App\Models\PropertyEnquirie;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PropertyEnquiryController extends Controller
{
    /**
     * Property Enquiries List View
     * Return property enquiries data in datatables format.
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTables
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PropertyEnquirie::latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    $fullName = trim($row->first_name . ' ' . $row->last_name);
                    return !empty($fullName) ? $fullName : 'N/A';
                })
                ->editColumn('phone', function ($row) {
                    return !empty($row->phone) ? $row->phone : 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? Carbon::parse($row->created_at)->format('d M, Y H:i A') : 'N/A';
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
                ->rawColumns(['full_name', 'email', 'action', 'created_at'])
                ->make(true);
        }

        return view('backend.layouts.propertyEnquirie.index');
    }

    /**
     * Show Enquiry Details
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $enquiry = PropertyEnquirie::with(['property', 'user', 'roomListings'])->findOrFail($id);
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
            $enquiry = PropertyEnquirie::findOrFail($id);
            $enquiry->delete();
            return response()->json(['t-success' => true, 'message' => 'Enquiry deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['t-success' => false, 'message' => 'Something went wrong!']);
        }
    }
}
