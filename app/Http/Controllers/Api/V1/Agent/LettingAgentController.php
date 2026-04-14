<?php

namespace App\Http\Controllers\Api\V1\Agent;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LettingAgentController extends Controller
{

    /**
     * Retrieve a list of agents with optional search and pagination
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @query int per_page The number of items to return per page. Defaults to 25.
     * @query string search Search for agents based on first name, last name, email, or phone. Optional.
     * @query int city_id The ID of the city to filter agents by. Optional.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 25);
            $search  = $request->query('search');
            $cityId  = $request->query('city_id');

            //Initialize Query
            $query = User::where('role', 'agent')->where('status', 'active')->orderByDesc('id')
                ->select('id', 'first_name', 'last_name', 'email', 'phone', 'avatar', 'cover_photo', 'about')
                ->withCount('properties')->with(['properties.city:id,name']);

            //Apply Filters (Before Paginating)
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            }
            //Apply City Filter
            if (! empty($cityId)) {
                $query->whereHas('properties', function ($q) use ($cityId) {
                    $q->where('city_id', $cityId);
                });
            }

            // Paginate and Transform the result
            $agents = $query->paginate($perPage)->tap(function ($items) {
                $items->getCollection()->transform(function ($agent) {
                    $agent->city_names   = $agent->properties->pluck('city.name')->filter()->unique()->values();
                    $agent->cities_count = $agent->city_names->count();
                    unset($agent->properties);
                    return $agent;
                });
            });

            return Helper::jsonResponse(true, 'Agents retrieved successfully.', 200, $agents);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error: ' . $e->getMessage(), 500);
        }
    }

    // public function index(Request $request)
    // {
    //     try {
    //         $perPage = $request->query('per_page', 25);

    //         $agents  = User::where('role', 'agent')->where('status', 'active')
    //             ->select('id', 'first_name', 'last_name', 'email', 'phone', 'avatar', 'cover_photo', 'about')
    //             ->withCount('properties')->with(['properties.city:id,name'])->paginate($perPage);

    //         $agents->getCollection()->transform(function ($agent) {
    //             $agent->city_names   = $agent->properties->map(fn($p) => $p->city->name ?? null)->filter()->unique()->values();
    //             $agent->cities_count = $agent->city_names->count();
    //             unset($agent->properties);
    //             return $agent;
    //         });

    //         return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $agents);
    //     } catch (Exception $e) {
    //         return Helper::jsonResponse(false, 'Error: ' . $e->getMessage(), 500);
    //     }
    // }

    /**
     * Retrieve CMS data restricted to specific sections.
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AllCMS(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section' => 'required|in:whoWeAre,generateDemand,whyProvidersChooseUs',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, $validator->errors()->first(), 422);
        }

        try {
            $section = $request->query('section');

            $cmsData = CMS::where('page', 'lettingAgentPage')
                ->where('section', $section)
                ->first();

            if (!$cmsData) {
                return Helper::jsonResponse(false, 'No CMS data found for this section.', 404);
            }

            if (!empty($cmsData->cards)) {
                $cmsData->cards = collect($cmsData->cards)->map(function ($card) {
                    if (isset($card['image']) && !empty($card['image'])) {
                        $card['image'] = asset($card['image']);
                    }
                    return $card;
                })->all();
            }

            return Helper::jsonResponse(true, 'CMS data retrieved successfully.', 200, $cmsData);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error: ' . $e->getMessage(), 500);
        }
    }
}
