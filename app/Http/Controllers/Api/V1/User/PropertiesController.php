<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\RoomListing;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{
    /**
     * Retrieve all properties with optional search and pagination
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            //request params with defaults
            $search         = $request->query('search');
            $perPage        = $request->query('per_page', 25);
            $featured       = $request->query('featured');
            $categoryId     = $request->query('category_id');
            $cityId         = $request->query('city_id');
            $minPrice       = $request->query('min_price');
            $maxPrice       = $request->query('max_price');
            $bedroomId      = $request->query('bedrooms');
            $status         = $request->query('status');
            $durationPeriod = $request->query('duration_period');
            $PropertyUserId = $request->query('property_user_id');

            //guard 'api' ensures JWT authentication
            $user   = Auth::guard('api')->user();
            $userId = $user ? $user->id : null;

            $query = Property::with(['universities', 'category:id,name', 'city:id,name']);

            //Search logic
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('university_name', 'like', "%{$search}%");
                });
            }
            //Filter logic Static filter
            if (! empty($PropertyUserId)) {
                $query->where('user_id', $PropertyUserId);
            }
            if (! empty($status)) {
                $query->where('status', $status);
            }
            if (! empty($categoryId)) {
                $query->where('category_id', $categoryId);
            }
            if (! empty($cityId)) {
                $query->where('city_id', $cityId);
            }
            if (isset($featured) && $featured !== '') {
                $query->where('is_feature', $featured);
            }
            if (! empty($bedroomId)) {
                $query->where('bedrooms', $bedroomId);
            }
            if (! empty($durationPeriod)) {
                $query->where('duration_period', $durationPeriod); //Weekly,Monthly
            }
            //Price filter between
            if ($minPrice !== null && $maxPrice !== null) {
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            }

            $properties = $query->paginate($perPage); //per page

            //Wishlist icon check
            $properties->getCollection()->transform(function ($item) use ($userId) {
                $item->favorite_icon = Wishlist::where('user_id', $userId)->where('property_id', $item->id)->exists();
                return $item;
            });
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $properties, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve a specific property by id.
     * @param int $id Property id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            //guard 'api' ensures JWT authentication
            $user   = Auth::guard('api')->user();
            $userId = $user ? $user->id : null;

            $properties = Property::with(['universities', 'category:id,name', 'city:id,name'])->find($id);
            if (! $properties) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }

            //Wishlist icon check
            $properties->favorite_icon = false;
            if ($userId) {
                $properties->favorite_icon = Wishlist::where('user_id', $userId)->where('property_id', $properties->id)->exists();
            }

            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $properties);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve all room listings.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roomTypes(Request $request)
    {
        try {
            $search       = $request->query('search');
            $perPage      = $request->query('per_page', 25);
            $status       = $request->query('status');
            $contractType = $request->query('contract_type');
            $roomType     = $request->query('room_type');
            $propertyId   = $request->query('property_id');

            $roomListings = RoomListing::with(['property:id,title']);

            if (! empty($propertyId)) {
                $roomListings->where('property_id', $propertyId);
            }
            if (! empty($search)) {
                $roomListings->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('price_per_week', 'like', '%' . $search . '%');
            }
            if (! empty($roomType)) {
                $roomListings->whereJsonContains('room_type', $roomType);
            }
            if (! empty($status)) {
                $roomListings->where('status', $status);
            }
            if (! empty($contractType)) {
                $roomListings->where('contract_type', $contractType);
            }

            $roomListings = $roomListings->paginate($perPage);
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $roomListings, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve all room-type categories for a property.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roomTypesCategory(Request $request)
    {
        try {
            $propertyId = $request->query('property_id');

            // Get all room listings for the property
            $roomListings = RoomListing::where('property_id', $propertyId)->get();

            if (! $roomListings) {
                return Helper::jsonResponse(false, 'Property not found.', 404);
            }

            // Get unique category IDs
            $categoryIds = $roomListings->map(function ($item) {
                $raw = $item->getRawOriginal('room_type');
                if (empty($raw)) {
                    return [];
                }
                return is_array($raw) ? $raw : json_decode($raw, true) ?? [];
            })->flatten()->unique()->filter()->values()->toArray();

            // dd($categoryIds);
            $categories = Category::whereIn('id', $categoryIds)->select('id', 'name')->get();
            //response
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $categories);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
