<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    // The attributes that are mass assignable.
    protected $guarded = [];


    // The attributes that should be hidden for serialization.
    protected $hidden = ['deleted_at'];
}
