<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['updated_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'name'          => 'string',
        'ip_address'    => 'string',
        'email'         => 'string',
        'phone'         => 'string',
        'conversations' => 'array',
        'room_type'     => 'array',
        'amenities'     => 'array',
        'images'        => 'array',
    ];

    // Relationships and other model methods can be added here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
