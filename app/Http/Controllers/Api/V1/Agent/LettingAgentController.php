<?php
namespace App\Http\Controllers\Api\V1\Agent;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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
            $query = User::where('role', 'agent')->where('status', 'active')
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
}
