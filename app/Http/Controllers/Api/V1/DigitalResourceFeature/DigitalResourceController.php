<?php

namespace App\Http\Controllers\Api\V1\DigitalResourceFeature;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DigitalResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DigitalResourceController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * Retrieve all active cities with optional search and pagination
     * @param Request $requestz
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'nullable',
            'type'     => 'required|in:pdf,video_url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            $perPage = $request->query('per_page', 25);
            $type    = $request->query('type');

            $query = DigitalResource::where('status', 'active');

            if (!empty($type)) {
                $query->where('type', $type);
            }

            $data = $query->paginate($perPage);

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
            $data = DigitalResource::where('status', 'active')->find($id);
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
