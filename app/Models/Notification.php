<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    protected $guarded = [];


    protected $casts = [
        'data' => 'array',  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
