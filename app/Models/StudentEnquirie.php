<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnquirie extends Model
{
    protected $guarded = [];

    protected $hidden = ['updated_at', 'deleted_at'];

    protected $casts = [
        'id'                       => 'integer',
        'user_id'                  => 'integer',
        'full_name'                => 'string',
        'email'                    => 'string',
        'phone'                    => 'string',
        'ip_address'               => 'string',
        'preferred_move_in_date'   => 'date',
        'message'                  => 'string',
        'status'                   => 'string',
        'created_at'               => 'datetime',
        'updated_at'               => 'datetime',
        'deleted_at'               => 'datetime',
    ];

    //relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
