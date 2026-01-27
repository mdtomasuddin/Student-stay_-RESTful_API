<?php

namespace App\Http\Controllers\Web\Backend\V1\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AgentMangementController extends Controller
{
    /**
     * Index of Agent Management
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agent::with(['city'])->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('city', function ($row) {
                    return $row->city ? $row->city->name : 'N/A';
                })
                ->editColumn('status', function ($row) {
                    $badges = [
                        'pending'   => 'bg-warning',
                        'approved'  => 'bg-success',
                        'verified'  => 'bg-info',
                        'rejected'  => 'bg-danger',
                        'cancelled' => 'bg-secondary',
                    ];
                    $class = $badges[$row->status] ?? 'bg-dark';
                    return '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('manage-agents.edit', $row->id) . '" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">view Details</a>
                    </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.agentManagement.index');
    }
}
