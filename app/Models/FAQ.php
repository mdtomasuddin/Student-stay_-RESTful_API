<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use HasFactory, SoftDeletes;

    // table prefix
    protected $table = 'faqs';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'status'];

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'question' => 'string',
            'answer'   => 'string',
        ];
    }
}
