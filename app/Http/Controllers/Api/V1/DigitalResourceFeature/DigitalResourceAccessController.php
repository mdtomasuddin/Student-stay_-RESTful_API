<?php

namespace App\Http\Controllers\Api\V1\DigitalResourceFeature;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DigitalResourceAccess;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DigitalResourceAccessController extends Controller
{
    /**
     * Store a newly created DigitalResourceAccess in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'digital_resource_id' => 'required|exists:digital_resources,id',
            ]);

            //validation
            if ($validator->fails()) {
                $message = $validator->errors()->first();
                return Helper::jsonResponse(false, $message, 422);
            }

            // Create or update DigitalResourceAccess
            $data = DigitalResourceAccess::firstOrCreate(
                [
                    'digital_resource_id' => $request->digital_resource_id,
                    'user_id'             => Auth::id(),
                ],
                [
                    'ip_address' => $request->ip(),
                ]
            );
            $data->increment('access_count');
            //response
            return Helper::jsonResponse(true, 'Digital Resource Access successfully', 201, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Operation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
