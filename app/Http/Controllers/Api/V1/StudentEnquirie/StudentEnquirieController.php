<?php
namespace App\Http\Controllers\Api\V1\StudentEnquirie;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\StudentEnquirie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentEnquirieController extends Controller
{

    /**
     * Store a newly created student enquiry in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            // Validate data
            $validator = Validator::make($request->all(), [
                'full_name'              => 'required|string|max:255',
                'email'                  => 'required|email|max:255',
                'phone'                  => [
                    'nullable',
                    'string',
                    'max:20',
                    'regex:/^(?:(?:\+44\s?7\d{3})|(?:07\d{3}))\s?\d{3}\s?\d{3}$/',
                ],
                'preferred_move_in_date' => 'nullable|date|after_or_equal:today',
                'referral_source_id'     => 'nullable|exists:categories,id',
                'message'                => 'nullable|string|max:2000',
            ]);

            //validation
            if ($validator->fails()) {
                $message = $validator->errors()->first();
                return Helper::jsonResponse(false, $message, 422);
            }

            // Get validated data
            $validated               = $validator->validated();
            $validated['user_id']    = Auth::user()->id ?? null;
            $validated['ip_address'] = $request->ip();
            $data                    = StudentEnquirie::create($validated);

            //response
            return Helper::jsonResponse(true, 'Student Enquiry Submitted successfully.', 201, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Student Enquiry creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
