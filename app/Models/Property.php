<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    protected $casts = [
        'available_from' => 'date',
        'price_amount' => 'decimal:2',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenities_property');
    }

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'bills_property');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function nearbyUniversities()
    {
        return $this->hasMany(NearbyUniversity::class);
    }

    public function contractLength()
    {
        return $this->belongsTo(ContractLength::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
