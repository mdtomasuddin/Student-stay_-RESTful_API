<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnquirie extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'                     => 'integer',
        'user_id'                => 'integer',
        'full_name'              => 'string',
        'email'                  => 'string',
        'phone'                  => 'string',
        'ip_address'             => 'string',
        'preferred_move_in_date' => 'date',
        'message'                => 'string',
        'status'                 => 'string',
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
        'deleted_at'             => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
