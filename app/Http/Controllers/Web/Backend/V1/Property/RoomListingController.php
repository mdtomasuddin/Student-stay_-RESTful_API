<?php

namespace App\Http\Controllers\Web\Backend\V1\Property;

use App\Http\Controllers\Controller;
use App\Models\RoomListing;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RoomListingController extends Controller
{
    /**
     * Display a listing of the room listings.
     *
     * @return View|JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RoomListing::with(['property'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('images', function ($row) {
                    if ($row->images && count($row->images) > 0) {
                        $html = '<div class="d-flex align-items-center gap-1">';
                        $limit = min(count($row->images), 3); // Max 3 images
                        for ($i = 0; $i < $limit; $i++) {
                            $html .= '<img src="' . $row->images[$i] . '" width="50" height="50" class="rounded border" style="object-fit:cover;">';
                        }
                        if (count($row->images) > 3) {
                            $remaining = count($row->images) - 3;
                            $html .= '<div class="d-flex align-items-center justify-content-center bg-light text-dark rounded border" style="width: 50px; height: 50px; font-weight: bold;">+' . $remaining . '</div>';
                        }
                        $html .= '</div>';
                        return $html;
                    }

                    return '<span class="text-muted">N/A</span>';
                })
                ->addColumn('property_title', function ($row) {
                    return $row->property ? $row->property->title : '<span class="text-danger">N/A</span>';
                })
                ->addColumn('room_type_name', function ($row) {
                    $types = $row->room_type;
                    if (is_array($types)) {
                        return collect($types)->pluck('name')->implode(', ');
                    }

                    return '<span class="text-danger">N/A</span>';
                })
                ->addColumn('move_in_date', function ($row) {
                    return $row->move_in_date ? $row->move_in_date->format('Y-m-d') : 'N/A';
                })
                ->addColumn('move_out_date', function ($row) {
                    return $row->move_out_date ? $row->move_out_date->format('Y-m-d') : 'N/A';
                })
                ->addColumn('price_per_week', function ($row) {
                    return $row->price_per_week ? '£'.number_format($row->price_per_week, 2) : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="'.route('room-listings.show', $row->id).'" class="btn btn-sm btn-outline-primary" title="View Details">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['images', 'property_title', 'room_type_name', 'action'])
                ->make(true);
        }

        return view('backend.layouts.properties.roomListings.index');
    }

    /**
     * Display the specified room listing.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function show($id)
    {
        try {
            $roomListing = RoomListing::with(['property', 'property.category', 'property.city', 'property.user'])->where('id', $id)->firstOrFail();

            return view('backend.layouts.properties.roomListings.show', compact('roomListing'));
        } catch (Exception $e) {
            return redirect()->route('room-listings.index')->with('t-error', 'Room listing not found');
        }
    }
}
