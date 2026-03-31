<?php

namespace App\Http\Controllers\Web\Backend\V1\CategoryFeature;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AmenitiesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('type', 'amenities')->select(['id', 'name', 'status'])->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $checked = $data->status === 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input onclick="changeStatus(event, ' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem; width: 40px;" name="status" ' . $checked . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('amenities.edit', $data->id) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $data->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.CategoryFeatures.amenities.index');
    }

    /**
     *creating a new data.
     */
    public function create()
    {
        return view("backend.layouts.CategoryFeatures.amenities.create");
    }

    /**
     * Store a newly created category data
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255|unique:categories,name',
        ]);
        try {
            $validatedData['type'] = 'amenities';
            Category::create($validatedData);
            return redirect()->route('amenities.index')->with('t-success', 'Data Create successfully!');
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Data not created",
            ]);
        }
    }

    /**
     * edit category data.
     * @param string $id`
     */
    public function edit(string $id)
    {
        $data = Category::where('type', 'amenities')->findOrFail($id);
        return view("backend.layouts.CategoryFeatures.amenities.edit", compact("data"));
    }

    /**
     * category update function.
     * @param Request $request
     * @param string $id
     */

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:200',
        ]);

        try {
            $data = Category::where('type', 'amenities')->findOrFail($id);
            $data->update($validatedData);
            return redirect()->route('amenities.index')->with('t-success', 'Data updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    /**
     *Delete
     * @param string $id
     */
    public function destroy(string $id)
    {
        try {
            $data = Category::where('type', 'amenities')->findOrFail($id);
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Data.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function status(Request $request, $id)
    {
        $data = Category::where('type', 'amenities')->find($id);
        if (! $data) {
            return response()->json([
                "success" => false,
                "message" => "Item not found.",
            ], 404);
        }

        $data->status = ($data->status == 'active') ? 'inactive' : 'active';
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'status changed successfully.',
        ]);
    }
}
