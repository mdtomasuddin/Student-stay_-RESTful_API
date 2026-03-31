<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class ChatHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): \Illuminate\View\View | \Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $data = Lead::latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    return $row->name ?: 'N/A';
                })
                ->addColumn('email', function ($row) {
                    return $row->email ?: 'N/A';
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone ?: 'N/A';
                })
                ->addColumn('ip_address', function ($row) {
                    return $row->ip_address ?: 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M, Y H:i A');
                })
                ->addColumn('actions', function ($data) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="'.route('chat-history.show', $data->id).'" class="btn btn-sm btn-outline-primary" title="View Details">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button onclick="deleteRecord(event, '.$data->id.')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete History">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.layouts.chatHistory.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $chat_history)
    {
        return view('backend.layouts.chatHistory.show', compact('chat_history'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Lead $chat_history): \Illuminate\Http\JsonResponse
    {
        try {
            $chat_history->delete();

            return response()->json([
                'success' => true,
                'message' => 'Chat history deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete chat history.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
