<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Exception;
use Illuminate\Http\Request;

class SeoMetaController extends Controller
{
    /**
     * Retrieve all SEO Meta records with optional page filter
     * ?page=homepage|accommodation|student_resources|blogs|letting_agents
     * ?search=keyword (searches in title and description)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $page   = $request->query('page'); // ['homepage', 'accommodation', 'student_resources', 'blogs', 'letting_agents']
            $search = $request->query('search');

            $query = SeoMeta::query();

            if (! empty($page)) {
                $query->where('page', $page);
            }
            // Search in title and description
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            $data = $query->get();
            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve details of a specific SEO Meta record by ID
     */
    public function show($id)
    {
        try {
            $seoMeta = SeoMeta::find($id);
            if (! $seoMeta) {
                return Helper::jsonResponse(false, 'Data not found', 404);
            }
            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully', 200, $seoMeta);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
