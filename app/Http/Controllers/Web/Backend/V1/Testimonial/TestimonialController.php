<?php

namespace App\Http\Controllers\Web\Backend\V1\Testimonial;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::query()->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    return '<img src="' . asset($data->image) . '"wh-40 " style="height: 80px; width:80px ;object-fit:cover; rounded-3;">';
                })
                ->addColumn('message', function ($data) {
                    $message      = $data->message;
                    $message      = preg_replace('/<p[^>]*>(.*?)<\/p>/is', '$1', $message);
                    $shortmessage = strlen($message) > 40 ? substr($message, 0, 40) . '...' : $message;
                    return $shortmessage;
                })
                ->addColumn('status', function ($data) {
                    $checked = $data->status === 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input onclick="changeStatus(event, ' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem; width: 40px;" name="status" ' . $checked . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="d-flex gap-2 justify-content-center">
                        <a href="' . route('testimonials.edit', $data->id) . '" class="btn btn-sm btn-outline-info btn-info-soft" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button onclick="deleteRecord(event, ' . $data->id . ')" class="btn btn-sm btn-outline-danger btn-danger-soft" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['message', 'image', 'status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.testimonial.index');
    }

    /**
     *creating a new data.
     */
    public function create()
    {
        return view("backend.layouts.testimonial.create");
    }

    /**
     * Store a newly created  data
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position'    => 'nullable|string|max:255',
            'message'     => 'required|string|max:1000',
        ]);
        try {
            if ($request->hasFile('image')) {
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'testimonial', time() . '_' . $request->file('image')->getClientOriginalName());
            }
            Testimonial::create($validatedData);
            return redirect()->route('testimonials.index')->with('t-success', 'Testimonial Create successfully!');
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "testimonial not created",
            ]);
        }
    }

    /**
     * edit Testimonial data.
     * @param string $id`
     */
    public function edit(string $id)
    {
        $data = Testimonial::findOrFail($id);
        return view("backend.layouts.testimonial.edit", compact("data"));
    }

    /**
     * Testimonial update function.
     * @param Request $request
     * @param string $id
     */

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'        => 'nullable|string|max:200',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'position'    => 'nullable|string|max:255',
            'message'     => 'required|string|max:1000',
        ]);

        try {
            $data = Testimonial::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($data && $data->image) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'testimonial');
            }

            $data->update($validatedData);

            return redirect()->route('testimonials.index')->with('t-success', 'testimonial updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    /**
     *Delete Testimonial. function
     * @param string $id
     */

    public function destroy(string $id)
    {
        try {
            $data = Testimonial::findOrFail($id);

            if (! empty($data->image)) {
                Helper::fileDelete(public_path($data->image));
            }

            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Testimonial deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Testimonial.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function status(Request $request, $id)
    {
        $data = Testimonial::find($id);

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
