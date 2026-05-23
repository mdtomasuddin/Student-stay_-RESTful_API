<?php

namespace App\Http\Controllers\Web\Backend\V1\Course;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Video;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        try {
            if ($request->ajax()) {
                $data = Video::with(['module.course'])->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('course_title', function ($data) {
                        return $data->module && $data->module->course ? (strlen($data->module->course->title) > 40 ? substr($data->module->course->title, 0, 40) . '...' : $data->module->course->title) : 'N/A';
                    })
                    ->addColumn('module_title', function ($data) {
                        return $data->module ? (strlen($data->module->title) > 40 ? substr($data->module->title, 0, 40) . '...' : $data->module->title) : 'N/A';
                    })
                    ->addColumn('title', function ($data) {
                        return strlen($data->title) > 40 ? substr($data->title, 0, 40) . '...' : $data->title;
                    })
                    ->addColumn('link', function ($data) {
                        if (str_contains($data->link, '<iframe')) {
                            return 'Embed Code';
                        }
                        return '<a href="' . $data->link . '" target="_blank">View Video</a>';
                    })
                    ->addColumn('status', function ($data) {
                        $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">';
                        $status .= '</div>';
                        return $status;
                    })
                    ->addColumn('action', function ($data) {
                        return '
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="javascript:void(0);" onclick="showVideoDetails(' . $data->id . ')" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewVideoModal" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="' . route('video.edit', ['video' => $data->id]) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>';
                    })
                    ->rawColumns(['link', 'module_title', 'course_title', 'title', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.course.video.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $courses = Course::where('status', 'active')->get();
        return view('backend.layouts.course.video.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        try {
            $video = new Video();
            $video->module_id = $request->module_id;
            $video->title = $request->title;
            $video->link = $request->link;
            $video->save();

            return redirect()->route('video.index')->with('t-success', 'Video created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create video');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = Video::with('module.course')->findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $video = Video::with('module.course')->findOrFail($id);
        $courses = Course::where('status', 'active')->get();
        $modules = Module::where('course_id', $video->module->course_id)->get();
        return view('backend.layouts.course.video.edit', compact('video', 'modules', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'link' => 'required|string',
        ]);

        try {
            $video = Video::findOrFail($id);
            $video->module_id = $request->module_id;
            $video->title = $request->title;
            $video->link = $request->link;
            $video->save();

            return redirect()->route('video.index')->with('t-success', 'Video updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update video');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $video = Video::findOrFail($id);
            $video->delete();
            return response()->json([
                't-success' => true,
                'message' => 'Video deleted successfully.',
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Change the status of the specified resource.
     */
    public function status(int $id): JsonResponse
    {
        try {
            $data = Video::findOrFail($id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();
                return response()->json([
                    'success' => false,
                    'message' => 'Video unpublished successfully.',
                    'data' => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Video published successfully.',
                    'data' => $data,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Get modules by course ID.
     */
    public function getModules(int $course_id): JsonResponse
    {
        try {
            $modules = Module::where('course_id', $course_id)->where('status', 'active')->get();
            return Helper::jsonResponse(true, 'Modules fetched successfully', 200, $modules);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }
}
