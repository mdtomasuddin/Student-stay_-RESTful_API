<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];
    
    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'status'];

    // The attributes that should be cast.
    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
