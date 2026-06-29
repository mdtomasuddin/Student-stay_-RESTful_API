<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordReset extends Model
{
    use HasFactory;

    //table prefix
    protected $table = 'password_resets';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at'];

    //timestamps
    public $timestamps = false;

    // The attributes that should be cast.
    public function user(): BelongsTo
    {
        if ($this->email) {
            return $this->belongsTo(User::class, 'email', 'email');
        } else {
            return $this->belongsTo(User::class, 'phone', 'phone');
        }
    }
}
