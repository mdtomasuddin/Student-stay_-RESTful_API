<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = [];

    protected $hidden = ['updated_at', 'deleted_at', 'notes'];

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
    //relations all to one
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
