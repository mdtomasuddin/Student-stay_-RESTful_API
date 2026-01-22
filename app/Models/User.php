<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token', 'updated_at', 'created_at', 'deleted_at', 'is_otp_verified', 'otp_expires_at', 'otp_verified_at', 'google_id', 'email_verified_at', 'otp'];

    protected function casts(): array
    {
        return [
            'id'                   => 'integer',
            'email_verified_at'    => 'datetime',
            'otp_verified_at'      => 'datetime',
            'password'             => 'hashed',
            'birthday'             => 'date',
            'first_name'           => 'string',
            'last_name'            => 'string',
            'email'                => 'string',
            'phone'                => 'string',
            "language"             => 'string',
            'avatar'               => 'string',
            'cover_photo'          => 'string',
            'address'              => 'string',
            'google_id'            => 'string',
            'facebook_id'          => 'string',
            'apple_id'             => 'string',
            'role'                 => 'string',
            'status'               => 'string',
            'subscription'         => 'boolean',
            'terms_and_conditions' => 'boolean',
            'created_at'           => 'datetime',
            'updated_at'           => 'datetime',
            'deleted_at'           => 'datetime',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    //getAvatarAttribute
    public function getAvatarAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    // Accessor for cover_photo
    public function getCoverPhotoAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    //refferal code auto generate
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (empty($user->referral_code)) {
                do {
                    $code = mt_rand(100000, 999999);
                } while (self::where('referral_code', $code)->exists());
                $user->referral_code = $code;
            }
        });
    }
}
