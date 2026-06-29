<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = [];

    // The attributes that should be cast.
    protected $casts = [
        'title'       => 'string',
        'slug'        => 'string',
        'content'     => 'string',
        'thumbnail'   => 'string',
        'status'      => 'string',
        'user_id'     => 'integer',
        'category_id' => 'integer',
        'is_featured' => 'boolean',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    // The attributes that should be appended to the model's array form.
    protected $appends = ['read_time'];

    //Accessor for thumbnail
    public function getThumbnailAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    // accesor for read time
    public function getReadTimeAttribute()
    {
        $words   = str_word_count(strip_tags($this->content));
        $minutes = max(1, ceil($words / 200));

        return $minutes . ' min read';
    }

    // Relationships and other model methods can be added here
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
