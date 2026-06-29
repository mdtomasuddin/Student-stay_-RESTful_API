<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalResourceAccess extends Model
{

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['updated_at', 'deleted_at'];
    
    // The attributes that should be cast.
    protected $casts = [
        'id'                  => 'integer',
        'digital_resource_id' => 'integer',
        'user_id'             => 'integer',
        'ip_address'          => 'string',
        'access_count'        => 'integer',
        'status'              => 'string',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
        'deleted_at'          => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function digital_resource()
    {
        return $this->belongsTo(DigitalResource::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
