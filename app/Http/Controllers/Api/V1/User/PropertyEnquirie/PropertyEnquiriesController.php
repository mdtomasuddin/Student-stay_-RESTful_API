<?php

namespace App\Http\Controllers\Api\V1\User\PropertyEnquirie;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PropertyEnquirie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PropertyEnquiriesController extends Controller
{
    /**
     * Store a newly created property enquiry in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            //guard 'api' ensures JWT authentication
            $user   = Auth::guard('api')->user();
            $userId = $user ? $user->id : null;

            // Validate data
            $validator = Validator::make($request->all(), [
                'property_id'              => 'required|exists:properties,id',
                'room_listing_id'          => 'nullable|exists:room_listings,id',
                'first_name'               => 'required|string|max:255',
                'last_name'                => 'nullable|string|max:255',
                'email'                    => 'required|email|max:255',
                'phone'                    => [
                    'required',
                    'string',
                    'max:20',
                    'regex:/^(\+?\d{1,4}[-\s]?)?(\(?\d{1,3}\)?[-\s]?)?\d{1,4}[-\s]?\d{1,4}[-\s]?\d{1,4}$/', // regex for phone number
                ],
                'university'               => 'required|string|max:255',
                'preferred_move_in_date'   => 'nullable|date|after_or_equal:today',
                'preferred_contact_method' => 'nullable|in:email,phone,whatsapp',
                'message'                  => 'nullable|string|max:2000',
                'is_student_accommodation' => 'nullable|boolean',
            ]);

            //validation
            if ($validator->fails()) {
                $message = $validator->errors()->first();
                return Helper::jsonResponse(false, $message, 422);
            }

            // Get validated data
            $validated            = $validator->validated();
            $validated['user_id'] = $userId;
            $data                 = PropertyEnquirie::create($validated);

            //response
            return Helper::jsonResponse(true, 'Property Enquiry Submitted successfully.', 201, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Property Enquiry creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
