<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    protected $hidden = ['updated_at', 'pivot'];

    protected $casts = [
        'id'              => 'integer',
        'user_id'         => 'integer',
        'category_id'     => 'integer',
        'location'        => 'string',
        'full_address'    => 'string',
        'price'           => 'decimal:2',
        'duration_period' => 'string',
        'available_from'  => 'date',
        'bedrooms'        => 'integer',
        'bathrooms'       => 'integer',
        'description'     => 'string',
        'amenities'       => 'array',
        'bill_included'   => 'array',
        'images'          => 'array',
        'is_feature'      => 'boolean',
        'is_available'    => 'boolean',
        'status'          => 'string',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'deleted_at'      => 'datetime',
    ];

    // images array accessor give
    public function getImagesAttribute($value): ?array
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

    //relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function universities()
    {
        return $this->belongsToMany(University::class, 'property_university');
    }

    /**
     * Return an array of amenity names for the given ids.
     * @param string|array $value  JSON array, return an empty array
     * @return array
     */
    public function getAmenitiesAttribute($value): array
    {
        if (empty($value)) {
            return [];
        }
        $ids = is_array($value) ? $value : json_decode($value, true);
        return Category::whereIn('id', $ids)->select('id', 'name')->get()->toArray();
    }

    public function getBillIncludedAttribute($value): array
    {
        if (empty($value)) {
            return [];
        }
        $ids = is_array($value) ? $value : json_decode($value, true);
        return Category::whereIn('id', $ids)->select('id', 'name')->get()->toArray();
    }
}
