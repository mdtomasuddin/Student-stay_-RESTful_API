<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'page'            => 'string',
        'section'         => 'string',
        'title'           => 'string',
        'description'     => 'string',
        'sub_title'       => 'string',
        'sub_description' => 'string',
        'sub_image'       => 'array',
        'image'           => 'string',
        'button'          => 'string',
        'sub_button'      => 'string',
        'status'          => 'string',
        'tag'             => 'array',
        'cards'           => 'array',
    ];

    // Accessor for image
    public function getImageAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    //Handles sub_image array
    public function getSubImageAttribute($value): ?array
    {
        if (empty($value)) {
            return null;
        }
        $data = is_array($value) ? $value : json_decode($value, true);
        if (! is_array($data)) {
            return null;
        }
        $urls = [];
        foreach ($data as $item) {
            $path = is_array($item) ? ($item['file'] ?? null) : $item;
            if ($path) {
                $urls[] = filter_var($path, FILTER_VALIDATE_URL) ? $path : url($path);
            }
        }
        return $urls;
    }

    //Accessing the cards array
    public function getCardsAttribute($value): ?array
    {
        if (empty($value)) {
            return null;
        }
        $data = is_array($value) ? $value : json_decode($value, true);
        if (! is_array($data)) {
            return null;
        }
        foreach ($data as &$card) {
            if (isset($card['image']) && ! empty($card['image'])) {
                $card['image'] = filter_var($card['image'], FILTER_VALIDATE_URL) ? $card['image'] : url($card['image']);
            }
        }
        return $data;
    }

    // Relationships and other model methods can be added here
}
