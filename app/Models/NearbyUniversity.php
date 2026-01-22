<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NearbyUniversity extends Model
{
    protected $guarded = [];

    protected $casts = [
        'university_name' => 'string',
        'distance' => 'string',
        'walk_time' => 'string',
        'cycle_time' => 'string',
        'drive_time' => 'string',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
