<?php

namespace App\Http\Controllers\Api\V1\Course;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage  = $request->query('per_page', 10);
            $moduleId = $request->query('module_id');

            $query = Video::where('status', 'active');

            // Filter by Module if ID is passed
            if (! empty($moduleId)) {
                $query->where('module_id', $moduleId);
            }

            $data = $query->latest()->paginate($perPage);

            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve data', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     * @param int $id
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = Video::where('status', 'active')->find($id);
            if (! $data) {
                return Helper::jsonResponse(false, 'Data not found', 404);
            }

            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve data', 404, ['error' => $e->getMessage()]);
        }
    }
}
