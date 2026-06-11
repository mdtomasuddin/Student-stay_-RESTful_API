<?php

namespace App\Http\Controllers\Web\Backend\V1\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactUsController extends Controller
{

    /**
     * Contact Us List View
     * Return contact us data in datatables format.
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTables|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUs::with(['placeOfStudy', 'property', 'referralSource'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('full_name', function ($row) {
                    return !empty($row->full_name) ? $row->full_name : 'N/A';
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
                ->rawColumns(['email', 'action', 'created_at'])
                ->make(true);
        }

        return view('backend.layouts.contactUs.index');
    }

    /**
     * Show Contact Details
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $enquiry = ContactUs::with(['placeOfStudy', 'property', 'referralSource', 'user'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $enquiry]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Contact details not found.']);
        }
    }

    /**
     * Delete Contact
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $enquiry = ContactUs::findOrFail($id);
            $enquiry->delete();
            return response()->json(['t-success' => true, 'message' => 'Contact deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['t-success' => false, 'message' => 'Something went wrong!']);
        }
    }
}
