<?php

namespace App\Services\Api\Coin;

use App\Models\Appointment;
use App\Models\PostShare;
use App\Models\Referral;
use App\Models\Review;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;

class TotalEarnCoinService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * total earning coins
     */
    public function TotalEarnCoins($userId)
    {
        // Appointment coins
        $appointmentCoins = Appointment::where('appointment_user_id', $userId)->with('services:id')->get()->pluck('services')
            ->flatten()->pluck('id')
            ->map(fn($serviceId) => Reward::where('service_id', $serviceId)->value('coin') ?? 0)->sum();

        // Referral coins (100 per referral)
        $referralCoins = Referral::where('user_id', $userId)->count() * 100;

        // Post share coins (10 per unique post)
        $postShareCoins = PostShare::where('user_id', $userId)->distinct('post_id')->count('post_id') * 10;

        // Review coins (50 per unique company reviewed)
        $reviewCoins = Review::where('user_id', $userId)->distinct('company_id')->count('company_id') * 50;

        // Total coins
        return $appointmentCoins + $referralCoins + $postShareCoins + $reviewCoins;
    }
}
