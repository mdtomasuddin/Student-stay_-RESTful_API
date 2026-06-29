<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for arrays.
    protected $hidden = ['created_at', 'updated_at', 'status'];

    // The attributes that should be cast.
    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'image'      => 'string',
        'position'   => 'string',
        'message'    => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Accessor for image.
    public function getImageAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    // Relationships and other model methods can be added here
}
