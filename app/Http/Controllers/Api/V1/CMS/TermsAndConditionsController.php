<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    /**
     * Terms And Conditions api
     */
    public function index($type)
    {
        try {

            $data = Content::select('id', 'type', 'title', 'content')->where('type', $type)->where('status', 'active')->first();

            if (!$data) {
                return Helper::jsonResponse(false, 'No Data Found .', 404);
            }
            $data->makeHidden(['type']);
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data .', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
