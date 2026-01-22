<?php

namespace App\Http\Controllers\Web\Backend\V1\CityFeatures;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{

    /**
     * Display a listing of the resource.
     * This function is used to display the list of cities.
     * If the request is an AJAX request, it will return
     * a DataTables object with the necessary columns.
     * If not an AJAX request, it will return the view
     * for the index page.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = City::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    return '<img src="' . asset($data->image) . '"wh-40 " style="height: 80px; width:80px ;object-fit:cover; rounded-3;">';
                })
                ->addColumn('status', function ($data) {
                    $checked = $data->status === 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input onclick="changeStatus(event, ' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem; width: 40px;" name="status" ' . $checked . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="d-flex gap-2 align-items-center justify-content-center">
                        <a href="' . route('cities.edit', $data->id) . '" class="btn btn-sm btn-outline-secondary rounded-circle p-1">
                            <i class="material-symbols-outlined">edit</i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger rounded-circle p-1" onclick="deleteRecord(event, ' . $data->id . ')">
                            <i class="material-symbols-outlined">delete</i>
                        </button>
                    </div>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.cities.index');
    }

    /**
     *creating a new data.
     */
    public function create()
    {
        return view("backend.layouts.cities.create");
    }

    /**
     * Store a newly created  data
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                 => 'required|string|max:255',
            'image'                => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university_name'      => 'required|string|max:255',
            'location'             => 'required|string|max:255',
            'properties_available' => 'required|integer',
        ]);
        try {
            if ($request->hasFile('image')) {
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'City', time() . '_' . $request->file('image')->getClientOriginalName());
            }
            City::create($validatedData);
            return redirect()->route('cities.index')->with('t-success', 'Data Create successfully!');
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Data not created",
            ]);
        }
    }

    /**
     * edit Data data.
     * @param string $id`
     */
    public function edit(string $id)
    {
        $data = City::findOrFail($id);
        return view("backend.layouts.cities.edit", compact("data"));
    }

    /**
     *  update function.
     * @param Request $request
     * @param string $id
     */

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'                 => 'nullable|string|max:200',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'university_name'      => 'nullable|string|max:255',
            'location'             => 'nullable|string|max:255',
            'properties_available' => 'nullable|integer',

        ]);

        try {
            $data = City::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($data && $data->image) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'City', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            $data->update($validatedData);

            return redirect()->route('cities.index')->with('t-success', 'Data updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    /**
     *Delete Data=
     * @param string $id
     */

    public function destroy(string $id)
    {
        try {
            $data = City::findOrFail($id);

            if (! empty($data->image)) {
                Helper::fileDelete(public_path($data->image));
            }

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
        $data = City::findOrFail($id);

        if (! $data) {
            return response()->json([
                "success" => false,
                "message" => "Data not found.",
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
