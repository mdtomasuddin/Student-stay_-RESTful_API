<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = [];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'status',
        'created_at'
    ];

    // protected $appends = ['price'];

    protected $casts = [
        'name'                => 'string',
        'offer_description'   => 'string',
        'billing_interval'    => 'string',
        'price'               => 'decimal:2',
        'currency'            => 'string',
        'description'         => 'string',
        'features'            => 'array',
        'is_recommended'      => 'boolean',
        'status'              => 'string',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
        'deleted_at'          => 'datetime',
    ];
}
