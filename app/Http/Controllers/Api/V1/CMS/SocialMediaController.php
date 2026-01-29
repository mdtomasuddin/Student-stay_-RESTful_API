<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Exception;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    // SocialMedia
    public function index(Request $request)
    {
        try {
            $data = SocialMedia::get();
            if (! $data) {
                return Helper::jsonResponse(false, 'No Data Found', 404);
            }
            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
