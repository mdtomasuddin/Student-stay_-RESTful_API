<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden.
    protected $hidden = ['updated_at', 'deleted_at'];

    // The attributes that should be cast.
    protected $casts = [
        'id'                     => 'integer',
        'full_name'              => 'string',
        'email'                  => 'string',
        'phone'                  => 'string',
        'place_of_study_id'      => 'integer',
        'budget'                 => 'string',
        'preferred_move_in_date' => 'date',
        'room_type_id'           => 'integer',
        'other_preferences'      => 'string',
        'referral_source_id'     => 'integer',
        'status'                 => 'string',
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
        'deleted_at'             => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function placeOfStudy()
    {
        return $this->belongsTo(Category::class, 'place_of_study_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'room_type_id');
    }
    public function referralSource()
    {
        return $this->belongsTo(Category::class, 'referral_source_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
