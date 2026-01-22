<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
