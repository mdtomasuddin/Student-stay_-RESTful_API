<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformSetting extends Model
{
    //table prefix
    protected $table = 'platform_settings';

    protected $fillable = ['key', 'value'];

    // The attributes that should be cast.
    protected $casts = [
        'key'   => 'string',
        'value' => 'decimal:2',
    ];

    // Relationships and other model methods can be added here

}
