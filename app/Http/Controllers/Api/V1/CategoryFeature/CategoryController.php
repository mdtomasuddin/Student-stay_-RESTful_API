<?php

namespace App\Http\Controllers\Api\V1\CategoryFeature;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Retrieve all active categories with optional type and search filters and pagination
     * type = propertyType || amenities || billIncluded || blogCategory || roomType || placeOfStudy || referralSource
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            //Parms
            $typeName = $request->query('type');
            $perPage  = $request->query('per_page', 25);
            $search   = $request->query('search');

            $query = Category::where('status', 'active');
            if ($typeName) {
                $query->where('type', $typeName); // Filter by type
            }

            // search
            if (! empty($search)) {
                $query->where('name', 'like', "%{$search}%");
            }

            $categories = $query->paginate($perPage);
            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $categories, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve data', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve details of a specific category by ID
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $category = Category::where('status', 'active')->find($id);
            if (! $category) {
                return Helper::jsonResponse(false, 'Category not found.', 404);
            }
            // Response
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $category);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve category details', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
