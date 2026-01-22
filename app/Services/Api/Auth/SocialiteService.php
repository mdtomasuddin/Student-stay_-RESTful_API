<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialiteService
{
    /**
     * Handle socialite login. || role: user,admin
     * @param string $provider || @param string $socialToken
     * @param string $role || @return array
     */
    public function loginWithSocialite(string $provider, string $socialToken, string $role = 'user'): array
    {
        if (! in_array($provider, ['google', 'facebook', 'apple'])) {
            throw new UnauthorizedHttpException('', 'Provider not supported');
        }

        try {
            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($socialToken);
        } catch (Exception $e) {
            Log::error(strtoupper($provider) . ' login error: ' . $e->getMessage());
            throw new UnauthorizedHttpException('', 'Invalid token or provider');
        }

        if (! $socialUser || ! $socialUser->getEmail()) {
            throw new UnauthorizedHttpException('', 'Invalid social user data');
        }

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'first_name'                 => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Unknown',
                'last_name'                  => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Unknown',
                'password'             => bcrypt(Str::random(16)),
                'email_verified_at'    => now(),
                'terms_and_conditions' => true,
                'role'                 => $role,
            ]
        );

        $token = JWTAuth::fromUser($user);

        return [
            'status'     => true,
            'message'    => $user->wasRecentlyCreated ? 'User registered successfully' : 'User logged in successfully',
            'code'       => 200,
            'token_type' => 'bearer',
            'token'      => $token,
            'data'       => [
                'id'    => $user->id,
                'first_name'  => $user->first_name,
                'last_name'   => $user->last_name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ];
    }
}
