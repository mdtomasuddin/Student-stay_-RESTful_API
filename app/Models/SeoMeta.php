<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    //table
    protected $table = 'seo_metas';

    //allow mass assignment
    protected $guarded = [];

    //hidden fields
    protected $hidden = ['updated_at', 'created_at'];

    //casts
    protected $casts = [
        'id'          => 'integer',
        'page'        => 'string',
        'title'       => 'string',
        'description' => 'string',
        'keywords'    => 'array',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
