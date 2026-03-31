<?php

namespace App\Http\Controllers\Web\Backend\V1\Course;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        try {
            if ($request->ajax()) {
                $data = Course::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('thumbnail', function ($data) {
                        $url = asset($data->thumbnail ?? 'backend/images/no-image.png');
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;"></a>';
                    })
                    ->addColumn('status', function ($data) {
                        $status  = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">';
                        $status .= '</div>';
                        return $status;
                    })
                    ->addColumn('action', function ($data) {
                        return '
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="javascript:void(0);" onclick="showCourseDetails(' . $data->id . ')" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewCourseModal" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                              <a href="' . route('course.edit', ['course' => $data->id]) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>';
                    })
                    ->rawColumns(['thumbnail', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.course.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.layouts.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $course              = new Course();
            $course->title       = $request->title;
            $course->description = $request->description;

            if ($request->hasFile('thumbnail')) {
                $course->thumbnail = Helper::fileUpload($request->file('thumbnail'), 'course', $request->title);
            }

            $course->save();

            return redirect()->route('course.index')->with('t-success', 'Course created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create course');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = Course::findOrFail($id);
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
        $course = Course::findOrFail($id);
        return view('backend.layouts.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $course              = Course::findOrFail($id);
            $course->title       = $request->title;
            $course->description = $request->description;

            if ($request->hasFile('thumbnail')) {
                if ($course->thumbnail) {
                    Helper::fileDelete(public_path($course->thumbnail));
                }
                $course->thumbnail = Helper::fileUpload($request->file('thumbnail'), 'course', $request->title);
            }

            $course->save();

            return redirect()->route('course.index')->with('t-success', 'Course updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update course');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $course = Course::findOrFail($id);
            if ($course->thumbnail) {
                Helper::fileDelete(public_path($course->thumbnail));
            }
            $course->delete();
            return response()->json([
                't-success' => true,
                'message'   => 'Course deleted successfully.',
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
            $data = Course::findOrFail($id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();
                return response()->json([
                    'success' => false,
                    'message' => 'Course unpublished successfully.',
                    'data'    => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Course published successfully.',
                    'data'    => $data,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }
}
