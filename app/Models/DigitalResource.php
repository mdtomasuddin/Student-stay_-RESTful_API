<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalResource extends Model
{
    use HasFactory;

    //table guarded attributes for the model
    protected $guarded = [];

    //hidden attributes for the model
    protected $hidden = ['created_at', 'updated_at', 'user_id', 'status'];

    //casts for the model attributes
    protected $casts = [
        'id'           => 'integer',
        'type'         => 'string',
        'image'        => 'string',
        'access'       => 'string',
        'title'        => 'string',
        'description'  => 'string',
        'file_path'    => 'string',
        'external_url' => 'string',
        'status'       => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    //Accessor for image
    public function getImageAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    //Accessor for file_path
    public function getFilePathAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }
}
