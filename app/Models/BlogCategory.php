<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
