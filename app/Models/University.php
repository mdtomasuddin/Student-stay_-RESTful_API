<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'distance'   => 'string',
        'walk_time'  => 'string',
        'cycle_time' => 'string',
        'drive_time' => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    public function agent()
    {
        return $this->hasMany(Agent::class);
    }
}
