<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsSubscription extends Model
{
    protected $guarded = [];

    protected $casts = [
        'email' => 'string',
    ];
}
