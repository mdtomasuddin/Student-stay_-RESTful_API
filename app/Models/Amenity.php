<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
    ];

     public function properties()
    {
        return $this->belongsToMany(Property::class, 'amenities_property');
    }
}
