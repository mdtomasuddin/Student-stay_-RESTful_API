<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerRequest extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'contact_date' => 'date',
        'contact_time' => 'datetime:H:i',
    ];
}
