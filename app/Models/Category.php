<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'image', 'status'];
    protected $casts  = [
        'id'         => 'integer',
        'type'       => 'string',
        'name'       => 'string',
        'image'      => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Accessor for image
    public function getImageAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
