<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyEnquirie extends Model
{
    protected $guarded = [];

    protected $hidden = ['updated_at'];

    protected $casts = [
        'id'                       => 'integer',
        'user_id'                  => 'integer',
        'property_id'              => 'integer',
        'first_name'               => 'string',
        'last_name'                => 'string',
        'email'                    => 'string',
        'phone'                    => 'string',
        'university'               => 'string',
        'preferred_move_in_date'   => 'date',
        'preferred_contact_method' => 'string',
        'message'                  => 'string',
        'is_student_accommodation' => 'boolean',
        'status'                   => 'string',
        'created_at'               => 'datetime',
        'updated_at'               => 'datetime',
        'deleted_at'               => 'datetime',
    ];

    //relationship
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
