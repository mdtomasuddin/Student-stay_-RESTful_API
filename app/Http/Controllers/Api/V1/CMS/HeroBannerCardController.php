<?php
namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;

class HeroBannerCardController extends Controller
{
    /**
     * Get "Hero Banner Cards" section data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = CMS::select('id', 'page', 'section', 'cards')
                ->where('page', 'homePage')->where('section', 'heroBannerCard')->first();

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
