<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'id'         => 'integer',
        'title'      => 'string',
        'content'    => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships and other model methods can be added here

}
