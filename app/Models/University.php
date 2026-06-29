<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for arrays.
    protected $hidden = ['created_at', 'updated_at', 'pivot', 'status', 'user_id'];

    // The attributes that should be cast.
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

    // Relationships and other model methods can be added here
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    public function agent()
    {
        return $this->hasMany(Agent::class);
    }
}
