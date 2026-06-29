<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;

    // table prefix
    protected $table = 'notification_settings';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'user_id'              => 'integer',
        'general_notification' => 'boolean',
        'sound'                => 'boolean',
        'vibration'            => 'boolean',
        'special_offer'        => 'boolean',
        'payment'              => 'boolean',
        'app_update'           => 'boolean',
        'other'                => 'boolean',
        'status'               => 'string',
    ];

    // Relationships and other model methods can be added here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
