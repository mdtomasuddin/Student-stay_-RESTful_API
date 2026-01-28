<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalResourceAccess extends Model
{
    protected $guarded = [];

    protected $hidden  = ['updated_at', 'deleted_at'];

    protected $casts = [
        'id'                     => 'integer',
        'digital_resource_id'    => 'integer',
        'user_id'                => 'integer',
        'ip_address'             => 'string',
        'access_count'           => 'integer',
        'status'                 => 'string',
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
        'deleted_at'             => 'datetime',
    ];


    public function digital_resource()
    {
        return $this->belongsTo(DigitalResource::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
