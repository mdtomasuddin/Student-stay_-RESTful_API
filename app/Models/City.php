<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'user_id', 'status'];

    // The attributes that should be cast.
    protected $casts = [
        'id'              => 'integer',
        'user_id'         => 'integer',
        'name'            => 'string',
        'image'           => 'string',
        'university_name' => 'string',
        'location'        => 'string',
        'status'          => 'string',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'deleted_at'      => 'datetime',
    ];

    //Accessor for image
    public function getImageAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    // Relationships and other model methods can be added here
    public function properties()
    {
        return $this->hasMany(Property::class, 'city_id');
    }

    // Accessor: get properties count for this city
    public function getPropertiesCountAttribute(): int
    {
        return $this->properties()->count();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function agent()
    {
        return $this->hasMany(Agent::class);
    }
}
