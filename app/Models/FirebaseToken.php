<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FirebaseToken extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $guarded = ['id'];

    // The attributes that should be hidden for serialization.
    protected $hidden = [];

    // The attributes that should be cast.
    protected $casts = [
        'id'         => 'integer',
        'token'      => 'string',
        'user_id'    => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
