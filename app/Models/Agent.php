<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['updated_at', 'deleted_at', 'notes'];

    // The attributes that should be cast.
    protected $casts = [
        'id'                       => 'integer',
        'full_name'                => 'string',
        'letting_agent_name'       => 'string',
        'email'                    => 'string',
        'phone'                    => 'string',
        'city_id'                  => 'integer',
        'source'                   => 'string',
        'properties_managed_count' => 'string',
        'date'                     => 'date',
        'notes'                    => 'string',
        'status'                   => 'string',
        'ip_address'               => 'string',
        'created_at'               => 'datetime',
        'updated_at'               => 'datetime',
        'deleted_at'               => 'datetime',
    ];

    // The attributes that should be appended to the model's array form.
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
