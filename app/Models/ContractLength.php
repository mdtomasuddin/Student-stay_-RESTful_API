<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractLength extends Model
{
    protected $guarded = [];

    protected $casts = [
        'duration' => 'string',
    ];
}
