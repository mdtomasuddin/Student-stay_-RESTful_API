<?php

namespace App\Http\Controllers\Web\Backend\V1\Course;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        try {
            if ($request->ajax()) {
                $data = Module::with('course')->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('course_title', function ($data) {
                        return $data->course ? (strlen($data->course->title) > 40 ? substr($data->course->title, 0, 40) . '...' : $data->course->title) : 'N/A';
                    })
                    ->addColumn('title', function ($data) {
                        return strlen($data->title) > 50 ? substr($data->title, 0, 50) . '...' : $data->title;
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
                            <a href="javascript:void(0);" onclick="showModuleDetails(' . $data->id . ')" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModuleModal" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="' . route('module.edit', ['module' => $data->id]) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>';
                    })
                    ->rawColumns(['status', 'title', 'course_title', 'action'])
                    ->make();
            }
            return view('backend.layouts.course.module.index');
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
        return view('backend.layouts.course.module.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $module = new Module();
            $module->course_id = $request->course_id;
            $module->title = $request->title;
            $module->description = $request->description;
            $module->save();

            return redirect()->route('module.index')->with('t-success', 'Module created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create module');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = Module::with('course')->findOrFail($id);
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
        $module = Module::findOrFail($id);
        $courses = Course::where('status', 'active')->get();
        return view('backend.layouts.course.module.edit', compact('module', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $module = Module::findOrFail($id);
            $module->course_id = $request->course_id;
            $module->title = $request->title;
            $module->description = $request->description;
            $module->save();

            return redirect()->route('module.index')->with('t-success', 'Module updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update module');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $module = Module::findOrFail($id);
            $module->delete();
            return response()->json([
                't-success' => true,
                'message' => 'Module deleted successfully.',
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
            $data = Module::findOrFail($id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();
                return response()->json([
                    'success' => false,
                    'message' => 'Module unpublished successfully.',
                    'data' => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Module published successfully.',
                    'data' => $data,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, ['error' => $e->getMessage()]);
        }
    }
}
