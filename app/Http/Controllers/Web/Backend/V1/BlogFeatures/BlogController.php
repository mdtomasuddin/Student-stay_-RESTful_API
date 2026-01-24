<?php

namespace App\Http\Controllers\Web\Backend\V1\BlogFeatures;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * This function is used to display the list of blogs.
     * If the request is an AJAX request, it will return
     * a DataTables object with the necessary columns.
     * If not an AJAX request, it will return the view
     * for the index page.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::with('category', 'user')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return Str::words($data->title, 3, '...');
                })
                ->addColumn('thumbnail', function ($data) {
                    $image = $data->thumbnail ?? asset('placeholder.png');
                    return '<img src="' . $image . '" style="height: 60px; width: 80px; object-fit: cover; border-radius: 4px;">';
                })
                ->addColumn('category', function ($data) {
                    return $data->category?->name ?? 'N/A';
                })
                ->addColumn('author', function ($data) {
                    return $data->user?->first_name . ' ' . $data->user?->last_name ?? 'N/A';
                })
                ->addColumn('featured', function ($data) {
                    $checked = $data->is_featured ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input onclick="toggleFeatured(event, ' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem; width: 40px;" ' . $checked . '>
                    </div>';
                })
                ->addColumn('status', function ($data) {
                    $checked = $data->status === 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input onclick="changeStatus(event, ' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem; width: 40px;" name="status" ' . $checked . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="d-flex gap-2 align-items-center justify-content-center">
                        <a href="' . route('blogs.show', $data->id) . '" class="btn btn-sm btn-outline-secondary rounded-circle p-1">
                            <i class="material-symbols-outlined">View</i>
                        </a>
                        <a href="' . route('blogs.edit', $data->id) . '" class="btn btn-sm btn-outline-secondary rounded-circle p-1">
                            <i class="material-symbols-outlined">Edit</i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger rounded-circle p-1" onclick="deleteRecord(event, ' . $data->id . ')">
                            <i class="material-symbols-outlined">delete</i>
                        </button>
                    </div>';
                })
                ->rawColumns(['thumbnail', 'featured', 'status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.blogs.index');
    }

    /**
     * Display a specific blog.
     * @param string $id
     */
    public function show(string $id)
    {
        $data = Blog::with('category', 'user')->findOrFail($id);
        return view("backend.layouts.blogs.show", compact("data"));
    }

    /**
     * Creating a new blog.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->where('type', 'blogCategory')->get();
        return view("backend.layouts.blogs.create", compact("categories"));
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string|min:5',
            'category_id' => 'required|integer|exists:categories,id',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        try {
            $validatedData['user_id'] = Auth::id() ?? null;
            $validatedData['slug'] = Helper::makeSlug(Blog::class, $validatedData['title']);

            // Convert status: checkbox checked = active, unchecked = inactive
            $validatedData['status'] = $request->has('status') ? 'active' : 'inactive';

            // Convert featured: checkbox checked = 1, unchecked = 0
            $validatedData['is_featured'] = $request->has('is_featured') ? 1 : 0;

            // If marking as featured, unfeature all other blogs
            if ($validatedData['is_featured']) {
                Blog::where('id', '!=', 0)->update(['is_featured' => 0, 'featured_at' => null]);
                $validatedData['featured_at'] = now();
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $validatedData['thumbnail'] = Helper::fileUpload(
                    $request->file('thumbnail'),
                    'Blogs',
                    time() . '_' . $request->file('thumbnail')->getClientOriginalName()
                );
            }

            Blog::create($validatedData);
            return redirect()->route('blogs.index')->with('t-success', 'Blog created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Edit blog.
     * @param string $id
     */
    public function edit(string $id)
    {
        $data = Blog::findOrFail($id);
        $categories = Category::where('status', 'active')->where('type', 'blogCategory')->get();
        return view("backend.layouts.blogs.edit", compact("data", "categories"));
    }

    /**
     * Update function.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'content'     => 'sometimes|string|min:5',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'thumbnail'   => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
        ]);

        try {
            $blog = Blog::findOrFail($id);

            // Update slug if title is provided
            if (isset($validatedData['title']) && !empty($validatedData['title'])) {
                $validatedData['slug'] = Helper::makeSlug(Blog::class, $validatedData['title']);
            }

            // Convert status: checkbox checked = active, unchecked = inactive
            if ($request->has('status') !== false) {
                $validatedData['status'] = $request->has('status') ? 'active' : 'inactive';
            }

            // Handle featured status
            if ($request->has('is_featured')) {
                // If marking as featured, unfeature all other blogs
                Blog::where('id', '!=', $id)->update([
                    'is_featured' => 0,
                    'featured_at' => null
                ]);

                $validatedData['is_featured'] = 1;
                $validatedData['featured_at'] = now();
            } else {
                $validatedData['is_featured'] = 0;
                $validatedData['featured_at'] = null;
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                if (!empty($blog->thumbnail)) {
                    Helper::fileDelete($blog->getRawOriginal('thumbnail'));
                }

                $validatedData['thumbnail'] = Helper::fileUpload(
                    $request->file('thumbnail'),
                    'Blogs',
                    time() . '_' . $request->file('thumbnail')->getClientOriginalName()
                );
            }

            $blog->update($validatedData);
            return redirect()->route('blogs.index')->with('t-success', 'Blog updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Delete Blog
     * @param string $id
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if (!empty($blog->thumbnail) && strpos($blog->thumbnail, 'http') === false) {
                Helper::fileDelete($blog->getRawOriginal('thumbnail'));
            }

            $blog->delete();
            return response()->json([
                'success' => true,
                'message' => 'Blog deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete blog.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change the status of the specified blog.
     */
    public function status(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if (!$blog) {
            return response()->json([
                "success" => false,
                "message" => "Blog not found.",
            ], 404);
        }

        $blog->status = ($blog->status == 'active') ? 'inactive' : 'active';
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => 'Status changed successfully.',
        ]);
    }

    /**
     * Toggle featured status of the specified blog.
     * Only one blog can be featured at a time.
     */
    public function toggleFeatured(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if (!$blog) {
                return response()->json([
                    "success" => false,
                    "message" => "Blog not found.",
                ], 404);
            }

            // If blog is not featured, set it as featured and remove featured status from all others
            if (!$blog->is_featured) {
                // Set all other blogs to not featured
                Blog::where('id', '!=', $id)->update([
                    'is_featured' => 0,
                    'featured_at' => null
                ]);

                // Set this blog as featured
                $blog->is_featured = 1;
                $blog->featured_at = now();
                $blog->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Blog marked as featured successfully.',
                ]);
            } else {
                // If already featured, unfeature it
                $blog->is_featured = 0;
                $blog->featured_at = null;
                $blog->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Blog removed from featured successfully.',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle featured status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Store file
            $path = Helper::fileUpload($file, 'blogs-content', time() . '_' . $file->getClientOriginalName());

            return response()->json([
                'url' => asset($path)
            ]);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }
}
