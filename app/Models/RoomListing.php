<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomListing extends Model
{

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['updated_at', 'pivot', 'user_id', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'                  => 'integer',
        'property_id'         => 'integer',
        'name'                => 'string',
        'room_type'           => 'array',
        'description'         => 'string',
        'images'              => 'array',
        'amenities'           => 'array',
        'contract_type'       => 'string',
        'move_in_date'        => 'date',
        'move_out_date'       => 'date',
        'tenancy_weeks_min'   => 'integer',
        'tenancy_weeks_max'   => 'integer',
        'price_per_week'      => 'float',
        'min_price'           => 'float',
        'max_price'           => 'float',
        'is_single_occupancy' => 'boolean',
        'is_available'        => 'boolean',
        'is_feature'          => 'boolean',
        'redirect_url'        => 'string',
        'status'              => 'string',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
        'deleted_at'          => 'datetime',
    ];

    /**
     * Get the images attribute with full URLs.
     */
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

    /**
     * Get the amenities attribute as category names.
     */
    public function getAmenitiesAttribute($value): array
    {
        if (empty($value)) {
            return [];
        }
        $ids = is_array($value) ? $value : json_decode($value, true);

        return Category::whereIn('id', $ids)->select('id', 'name')->get()->toArray();
    }

    // room type attribute as category names
    public function getRoomTypeAttribute($value): array
    {
        if (empty($value)) {
            return [];
        }
        $ids = is_array($value) ? $value : json_decode($value, true);

        return Category::whereIn('id', $ids)->select('id', 'name')->get()->toArray();
    }

    // Relationships and other model methods can be added here
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function propertyEnquiries()
    {
        return $this->hasMany(PropertyEnquirie::class);
    }
}
