<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'bills_property');
    }
}
