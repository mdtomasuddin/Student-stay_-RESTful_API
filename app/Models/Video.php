<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at','status'];

    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'link' => 'string',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
