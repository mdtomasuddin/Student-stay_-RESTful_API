<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'status'];

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
}
