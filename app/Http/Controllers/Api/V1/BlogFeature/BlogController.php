<?php

namespace App\Http\Controllers\Api\V1\BlogFeature;

use App\Helpers\Helper;
use App\Http\Controllers\Api\V1\Controller;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * Retrieve all active blogs with optional search, category filter and pagination
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 25);
            $search  = $request->query('search');
            $categoryId = $request->query('category_id');

            // 1. Filter by Active Blogs AND Active Categories
            $query = Blog::where('status', 'active')
                ->whereHas('category', function ($q) {
                    $q->where('status', 'active');
                });

            // Search filter
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            }

            // Category filter
            if (!empty($categoryId)) {
                $query->where('category_id', $categoryId);
            }

            // Featured filter
            if (!empty($featured) && $featured == 'true') {
                $query->where('is_featured', true);
            }

            $data = $query->with('category', 'user')
                ->latest()
                ->paginate($perPage);

            return Helper::jsonResponse(true, 'Blogs retrieved successfully.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve blogs', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Retrieve details of a specific blog by ID
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = Blog::where('status', 'active')
                ->whereHas('category', function ($q) {
                    $q->where('status', 'active');
                })->with('category', 'user')->find($id);
            if (!$data) {
                return Helper::jsonResponse(false, 'Blog not found.', 404);
            }
            // Response
            return Helper::jsonResponse(true, 'Blog retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve blog', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created blog in storage
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'thumbnail'   => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Validate category status if category_id is provided
        if ($request->filled('category_id')) {
            $category = Category::find($request->input('category_id'));
            if (!$category || $category->status !== 'active') {
                return Helper::jsonResponse(false, 'Category must be active.', 422);
            }
        }

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation failed.', 422, $validator->errors());
        }

        $validatedData = $validator->validated();

        try {
            $validatedData['user_id'] = Auth::check() ? Auth::id() : null;
            $validatedData['slug'] = Helper::makeSlug(Blog::class, $validatedData['title']);

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $validatedData['thumbnail'] = Helper::fileUpload(
                    $request->file('thumbnail'),
                    'Blogs',
                    time() . '_' . $request->file('thumbnail')->getClientOriginalName()
                );
            }

            $blog = Blog::create($validatedData);
            $blog->load('category:id,name', 'user:id,name,email');

            return Helper::jsonResponse(true, 'Blog created successfully.', 201, $blog);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to create blog', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Update the specified blog in storage
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::find($id);
            if (!$blog) {
                return Helper::jsonResponse(false, 'Blog not found.', 404);
            }

            $validator = Validator::make($request->all(), [
                'title'       => 'nullable|string|max:255',
                'content'     => 'nullable|string|max:90000',
                'category_id' => 'nullable|integer|exists:categories,id',
                'thumbnail'   => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'      => 'nullable|in:active,inactive,draft',
            ]);

            // Validate category status if category_id is provided
            if ($request->filled('category_id')) {
                $category = Category::find($request->input('category_id'));
                if (!$category || $category->status !== 'active') {
                    return Helper::jsonResponse(false, 'Category must be active.', 422);
                }
            }

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation failed.', 422, $validator->errors());
            }

            $validatedData = $validator->validated();

            // Update slug if title is provided
            if (isset($validatedData['title'])) {
                $validatedData['slug'] = Helper::makeSlug(Blog::class, $validatedData['title']);
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail safely (bypass accessor)
                if (!empty($blog->thumbnail)) {
                    Helper::fileDelete($blog->getRawOriginal('thumbnail'));
                }

                $validatedData['thumbnail'] = Helper::fileUpload(
                    $request->file('thumbnail'),
                    'Blogs',
                    time() . '_' . $request->file('thumbnail')->getClientOriginalName()
                );
            }
            // Update the blog
            $blog->update($validatedData);
            $blog->load('category', 'user');

            return Helper::jsonResponse(true, 'Blog updated successfully.', 200, $blog);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to update blog', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Remove the specified blog from storage
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::find($id);
            if (!$blog) {
                return Helper::jsonResponse(false, 'Blog not found.', 404);
            }

            // Delete thumbnail
            if (!empty($blog->getRawOriginal('thumbnail'))) {
                Helper::fileDelete($blog->getRawOriginal('thumbnail'));
            }

            $blog->delete();

            return Helper::jsonResponse(true, 'Blog deleted successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to delete blog', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Return the latest featured blog
     * @return \Illuminate\Http\JsonResponse
     */
    public function featured()
    {
        try {
            $blog = Blog::where('status', 'active')
                ->where('is_featured', true)
                ->with('category', 'user')
                ->whereHas('category', function ($q) {
                    $q->where('status', 'active');
                })
                ->orderByDesc('featured_at')
                ->first();

            if (!$blog) {
                return Helper::jsonResponse(false, 'No featured blog found.', 404);
            }

            return Helper::jsonResponse(true, 'Latest featured blog retrieved successfully.', 200, $blog);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve featured blog.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
