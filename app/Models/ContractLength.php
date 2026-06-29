<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractLength extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'duration' => 'string',
    ];
}
