<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    //table prefix
    protected $table = 'seo_metas';

    // The attributes that are mass assignable.
    protected $guarded = [];

    //  The attributes that should be hidden for serialization.
    protected $hidden = ['updated_at', 'created_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'          => 'integer',
        'page'        => 'string',
        'title'       => 'string',
        'description' => 'string',
        'keywords'    => 'array',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    // Relationships and other model methods can be added here
}
