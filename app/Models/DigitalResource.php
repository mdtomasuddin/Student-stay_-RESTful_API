<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalResource extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'user_id', 'status'];

    protected $casts = [
        'type'   => 'string',
        'access' => 'string',
        'title' => 'string',
        'description' => 'string',
        'file_path' => 'string',
        'external_url' => 'string',
        'status' => 'string',
    ];

    //Accessor for file_path
    public function getFilePathAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }
}
