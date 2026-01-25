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


    public function index(Request $request)
    {
        try {
            //request params
            $search     = $request->query('search');
            $perPage    = $request->query('per_page', 25);
            $featured   = $request->query('featured');
            $categroyId = $request->query('category_id');  //propertytype category

            $status     = $request->query('status');
            $Sortby     = $request->query('sort_by');

            //guard 'api' ensures JWT authentication
            $user   = Auth::guard('api')->user();
            $userId = $user ? $user->id : null;

            $properties = Property::with(['universities', 'category:id,name']);

            //search && filter
            if (! empty($search)) {
                $properties->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('university_name', 'like', '%' . $search . '%');
            }
            if (! empty($status)) {
                $properties->where('status', $status);
            }
            if (! empty($categroyId)) {
                $properties->where('category_id', $categroyId); //property type category wish
            }
            if (! empty($featured)) {
                $properties->where('is_feature', $featured);
            }
            if (! empty($Sortby)) {
                $properties->orderBy($Sortby, 'desc');
            }

            $properties = $properties->paginate($perPage);

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
