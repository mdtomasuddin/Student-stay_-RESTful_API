<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Property;
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
}
