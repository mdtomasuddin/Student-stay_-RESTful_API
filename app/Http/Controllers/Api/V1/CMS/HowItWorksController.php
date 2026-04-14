<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;

class HowItWorksController extends Controller
{
    /**
     * Get "How It Works" section data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = CMS::select('id', 'page', 'section', 'title', 'description', 'cards')
                ->where('page', 'homePage')->where('section', 'howItWorks')->first();

            // check
            if (! $data) {
                return Helper::jsonResponse(false, 'Data not found', 404);
            }
            // response
            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
