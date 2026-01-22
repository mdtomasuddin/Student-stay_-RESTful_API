<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'university_name' => 'string',
        'preferred_contact' => 'string',
        'message' => 'string',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
