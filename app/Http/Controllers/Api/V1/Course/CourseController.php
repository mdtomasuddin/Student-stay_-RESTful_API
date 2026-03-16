<?php
namespace App\Http\Controllers\Api\V1\Course;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->query('per_page', 10);
            $search  = $request->query('search');

            $query = Course::where('status', 'active');

            // Search by title or description
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            $data = $query->latest()->paginate($perPage);

            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve data', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = Course::where('status', 'active')->find($id);
            if (! $data) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }

            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve data', 404, ['error' => $e->getMessage()]);
        }
    }
}
