<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class wishlistController extends Controller
{
    /**
     * Index function to retrieve wishlist data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $userId  = Auth::id();
            $perPage = $request->query('per_page', 25);

            $query = Wishlist::with([
                'property',
                'property.user:id,first_name,last_name,avatar,email,phone,address',
                'property.category:id,name',
                'property.universities',
            ])->where('user_id', $userId);
            $wishlists = $query->paginate($perPage); //per page

            //Execute the query
            $wishlists->getCollection()->transform(function ($item) {
                $item->favorite_icon = true;
                return $item;
            });

            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $wishlists, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created wishlist in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'property_id' => 'required|integer|exists:properties,id',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, $validator->errors()->first(), 422);
            }
            $userId     = Auth::id();
            $PropertyId = $request->input('property_id');

            // Check if the property is already in the wishlist
            $existingWishlist = Wishlist::where('user_id', $userId)->where('property_id', $PropertyId)->first();
            if ($existingWishlist) {
                $existingWishlist->delete();
                return Helper::jsonResponse(true, 'Removed from wishlist successfully.', 200);
            } else {
                Wishlist::create([
                    'user_id'     => $userId,
                    'property_id' => $PropertyId,
                ]);
                return Helper::jsonResponse(true, 'Added  wishlist successfully.', 201);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to process wishlist request.', 500);
        }
    }
}
