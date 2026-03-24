<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'name'          => 'string',
        'ip_address'    => 'string',
        'email'         => 'string',
        'phone'         => 'string',
        'conversations' => 'array',
        'room_type'     => 'array',
        'amenities'     => 'array',
        'images'        => 'array',
    ];

    // relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
