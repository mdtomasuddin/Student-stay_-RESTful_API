<?php

namespace App\Http\Controllers\Api\V1\ContactUs;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{

    /**
     * Store a newly created contact us in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            //guard 'api' ensures JWT authentication
            $user   = Auth::guard('api')->user();
            $userId = $user ? $user->id : null;

            // Validate data
            $validator = Validator::make($request->all(), [
                'full_name'              => 'nullable|string|max:255',
                'email'                  => 'nullable|email|max:255',
                'phone'                  => [
                    'nullable',
                    'string',
                    'max:20',
                    'regex:/^(?:(?:\+44\s?7\d{3})|(?:07\d{3}))\s?\d{3}\s?\d{3}$/',
                ],
                'place_of_study_id'      => 'nullable|exists:categories,id',
                'budget'                 => 'nullable|string|max:255',
                'preferred_move_in_date' => 'nullable|date|after_or_equal:today',
                'room_type_id'           => 'nullable|exists:categories,id',
                'other_preferences'      => 'nullable|string|max:2000',
                'referral_source_id'     => 'nullable|exists:categories,id',
            ]);

            //validation
            if ($validator->fails()) {
                $message = $validator->errors()->first();
                return Helper::jsonResponse(false, $message, 422);
            }

            // Get validated data
            $validated            = $validator->validated();
            $validated['user_id'] = $userId;
            $data                 = ContactUs::create($validated);

            //response
            return Helper::jsonResponse(true, 'Contact Us Submitted successfully.', 201, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Contact Us creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
