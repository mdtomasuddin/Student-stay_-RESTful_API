<?php
namespace App\Http\Controllers\Api\V1\CityFeature;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * Retrieve all active cities with optional search and pagination
     * @param Request $requestz
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 25);
            $search  = $request->query('search');

            $query = City::withCount('properties')
                ->where('status', 'active')
                ->orderByDesc('properties_count')
                ->orderByDesc('id');

            //search
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('university_name', 'like', "%{$search}%");
                });
            }
            $data = $query->paginate($perPage);

            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve list', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve details of a specific  by ID
     * @param int ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = City::withCount('properties')->where('status', 'active')->find($id);
            if (! $data) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }
            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve  list', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
