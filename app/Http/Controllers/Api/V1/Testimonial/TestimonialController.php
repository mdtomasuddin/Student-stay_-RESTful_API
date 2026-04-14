<?php

namespace App\Http\Controllers\Api\V1\Testimonial;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * Retrieve all active  optional search and pagination
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 50); // Default to 50
            $search  = $request->query('search');

            $query = Testimonial::where('status', 'active')->orderByDesc('id');

            //search Testimonial name
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }

            // Paginate the results
            $data = $query->paginate($perPage);
            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve  list', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve details of a specific Testimonial by ID
     * @param int $id - Testimonial ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = Testimonial::where('status', 'active')->find($id);
            if (! $data) {
                return Helper::jsonResponse(false, 'Testimonial not found.', 404);
            }

            //response
            return Helper::jsonResponse(true, 'Data  retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve  list', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
