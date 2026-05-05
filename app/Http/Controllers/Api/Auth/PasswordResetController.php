<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\OTPRequest;
use App\Http\Requests\Api\Auth\OTPVerificationRequest;
use App\Http\Requests\Api\Auth\PasswordResetRequest;
use App\Services\Api\Auth\PasswordResetService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    private PasswordResetService $passwordResetService;
    private Helper $helper;

    public function __construct(PasswordResetService $passwordResetService, Helper $helper)
    {
        $this->passwordResetService = $passwordResetService;
        $this->helper               = $helper;
    }

    /**
     * Send OTP code to the user's email.
     */
    public function sendOtpToEmail(OTPRequest $request): JsonResponse
    {
        try {
            $email    = $request->input('email');
            $response = $this->passwordResetService->sendOtpToEmail($email);

            return $this->helper->jsonResponse(true, $response['message'], 200, ['otp' => $response['otp']]);
        } catch (Exception $e) {
            return $this->helper->jsonResponse(false, $e->getMessage(), 400);
        }
    }

    /**
     * Verify the provided OTP code.
     */
    public function verifyOTP(OTPVerificationRequest $request): JsonResponse
    {
        try {
            $email    = $request->header('email') ?: $request->input('email');
            $otp      = $request->input('otp');
            $response = $this->passwordResetService->verifyOtp([
                'email' => $email,
                'otp'   => $otp,
            ]);

            return $this->helper->jsonResponse(true, $response['message'], 200);
        } catch (Exception $e) {
            return $this->helper->jsonResponse(false, $e->getMessage(), 400);
        }
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(PasswordResetRequest $request): JsonResponse
    {
        try {
            $email    = $request->header('email') ?: $request->input('email');
            $password = $request->input('password');
            $response = $this->passwordResetService->resetPassword([
                'email'    => $email,
                'password' => $password,
            ]);

            return $this->helper->jsonResponse(true, $response['message'], 200);
        } catch (Exception $e) {
            return $this->helper->jsonResponse(false, $e->getMessage(), 400);
        }
    }

    /**
     * Change the user's password
     */
    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required|string',
            'password'     => 'required|string|min:6|confirmed',
        ]);
        // dd($validatedData);
        try {
            $user = auth('api')->user();
            // dd($user);
            // Check if the current password matches the stored password
            if (! Hash::check($validatedData['old_password'], $user->password)) {
                return $this->helper->jsonResponse(false, 'Current password is incorrect', 422);
            }

            // Update the password
            $user->update([
                'password' => bcrypt($validatedData['password']),
            ]);
            return $this->helper->jsonResponse(true, 'Password updated successfully', 200);
        } catch (Exception $e) {
            Log::error('UserController::changePassword' . $e->getMessage());
            return $this->helper->jsonResponse(false, 'something went wrong', 403);
        }
    }

    /**
     * Get user information.
     */
    public function userInfo()
    {
        // dd(auth('api')->user()); // Remove this for production
        return Helper::jsonResponse(true, 'User details fetched successfully', 200, auth('api')->user());
    }

    /**
     * Update user profile information.
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'  => 'nullable|string|max:255',
            'last_name'   => 'nullable|string|max:255',
            'avatar'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico,avif,webm|max:204800',
            'cover_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico,avif,webm|max:204800',
            'phone'       => [
                'nullable',
                'string',
                'max:20',
                'regex:/^(?:(?:\+44\s?7\d{3})|(?:07\d{3}))\s?\d{3}\s?\d{3}$/',
            ],
            'address'     => 'nullable|string|max:255',
            'website'     => 'nullable|url|max:400',
            'about'       => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user          = auth('api')->user();
            $validatedData = $validator->validated();

            if (! empty($validatedData['phone'])) {
                $validatedData['phone'] = preg_replace('/\s+/', '', $validatedData['phone']);
            }

            // Handle avatar image update
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    $parsedUrl    = parse_url($user->avatar, PHP_URL_PATH);
                    $oldImagePath = ltrim($parsedUrl, '/');
                    Helper::fileDelete($oldImagePath);
                }
                $uploadedAvatar          = Helper::fileUpload($request->file('avatar'), 'userProfile', $request->file('avatar'));
                $validatedData['avatar'] = $uploadedAvatar;
            }

            // Handle cover photo update
            if ($request->hasFile('cover_photo')) {
                if ($user->cover_photo) {
                    $parsedUrl    = parse_url($user->cover_photo, PHP_URL_PATH);
                    $oldImagePath = ltrim($parsedUrl, '/');
                    Helper::fileDelete($oldImagePath);
                }

                $uploadedCover                = Helper::fileUpload($request->file('cover_photo'), 'userProfile', $request->file('cover_photo'));
                $validatedData['cover_photo'] = $uploadedCover;
            }

            $user->update($validatedData);
            return Helper::jsonResponse(true, 'Profile updated successfully', 200, $user);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'Something went wrong', 500, $e->getMessage());
        }
    }
}
