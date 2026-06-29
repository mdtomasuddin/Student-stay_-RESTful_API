<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{

    use HasFactory, SoftDeletes;

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'         => 'integer',
        'type'       => 'string',
        'title'      => 'string',
        'slug'       => 'string',
        'content'    => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships and other model methods can be added here
}
