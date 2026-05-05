<?php

namespace App\Http\Controllers\Web\Backend\V1\DigitalResourceFeatures;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DigitalResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DigitalResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     * This function is used to display the list of digital resources.
     * If the request is an AJAX request, it will return
     * a DataTables object with the necessary columns.
     * If not an AJAX request, it will return the view
     * for the index page.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DigitalResource::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    if ($data->image) {
                        return '<img src="' . asset($data->image) . '" style="height: 60px; width:60px; object-fit:cover; border-radius:8px;">';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('type', function ($data) {
                    if ($data->type === 'video_url') {
                        $url = $data->external_url ?? url($data->file_path);
                        return $url ? '<a href="' . $url . '" target="_blank">Watch Video</a>' : 'Video';
                    } elseif ($data->type === 'pdf') {
                        $url = url($data->file_path);
                        return $url ? '<a href="' . $url . '" target="_blank">View PDF</a>' : 'PDF';
                    }
                    return ucfirst($data->type);
                })
                ->addColumn('description', function ($data) {
                    return Str::words($data->description, 8, '...');
                })

                ->addColumn('status', function ($data) {
                    $checked = $data->status === 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input onclick="changeStatus(event, ' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem; width: 40px;" name="status" ' . $checked . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('digital-resources.edit', $data->id) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $data->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['image', 'type', 'access', 'status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.digital-resources.index');
    }

    /**
     * Create a new digital resource.
     */
    public function create()
    {
        return view("backend.layouts.digital-resources.create");
    }

    /**
     * Store a newly created digital resource
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type'        => 'required|in:video_url,pdf',
            // 'access'      => 'required|in:free,paid',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:409600',
            'external_url' => 'nullable|url',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico,avif,webm|max:204800',
        ]);
        try {
            if ($request->hasFile('file_path')) {
                $validatedData['file_path'] = Helper::fileUpload($request->file('file_path'), 'DigitalResources', time() . '_' . $request->file('file_path')->getClientOriginalName());
            }
            if ($request->hasFile('image')) {
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'DigitalResources', time() . '_' . $request->file('image')->getClientOriginalName());
            }
            $validatedData['access'] = 'free';
            DigitalResource::create($validatedData);
            return redirect()->route('digital-resources.index')->with('t-success', 'Digital Resource created successfully!');
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Digital Resource not created",
            ]);
        }
    }

    /**
     * Edit digital resource.
     * @param string $id
     */
    public function edit(string $id)
    {
        $data = DigitalResource::findOrFail($id);
        return view("backend.layouts.digital-resources.edit", compact("data"));
    }

    /**
     * Update function.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'type'        => 'nullable|in:video_url,pdf',
            'access'      => 'nullable|in:free,paid',
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:409600',
            'external_url' => 'nullable|url',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico,avif,webm|max:204800',
        ]);

        try {
            $data = DigitalResource::findOrFail($id);

            if ($request->hasFile('file_path')) {
                if ($data && $data->file_path) {
                    Helper::fileDelete(public_path($data->file_path));
                }
                $validatedData['file_path'] = Helper::fileUpload($request->file('file_path'), 'DigitalResources', time() . '_' . $request->file('file_path')->getClientOriginalName());
            }

            if ($request->hasFile('image')) {
                if ($data && $data->image) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'DigitalResources', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            $data->update($validatedData);

            return redirect()->route('digital-resources.index')->with('t-success', 'Digital Resource updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Delete Digital Resource
     * @param string $id
     */
    public function destroy(string $id)
    {
        try {
            $data = DigitalResource::findOrFail($id);

            if (!empty($data->file_path)) {
                Helper::fileDelete(public_path($data->file_path));
            }

            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Digital Resource deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Digital Resource.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function status(Request $request, $id)
    {
        $data = DigitalResource::findOrFail($id);

        if (!$data) {
            return response()->json([
                "success" => false,
                "message" => "Digital Resource not found.",
            ], 404);
        }

        $data->status = ($data->status == 'active') ? 'inactive' : 'active';
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Status changed successfully.',
        ]);
    }
}
