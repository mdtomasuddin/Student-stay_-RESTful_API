<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    /**
     * AllHeroSections
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception 
     * page=homePage, lettingAgentPage, partnerPage, studentBlogPage;
     */
    public function AllHeroSections(Request $request)
    {
        try {
            $pageName = $request->query('page');
            $data     = CMS::select('id', 'page', 'title', 'sub_title', 'description', 'image')->where('page', $pageName)->where('section', 'hero')->get();
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
