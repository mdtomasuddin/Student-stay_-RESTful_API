<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'system_settings';

    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'id'                => 'integer',
        'title'             => 'string',
        'system_name'       => 'string',
        'email'             => 'string',
        'contact_number'    => 'string',
        'company_open_hour' => 'string',
        'copyright_text'    => 'string',
        'logo'              => 'string',
        'favicon'           => 'string',
        'address'           => 'string',
        'description'       => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    // Relationships and other model methods can be added here
    public function getFileUrlAttribute($value): ?string
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        if (request()->is('api/*') && ! empty($value)) {
            return url($value);
        }

        return $value;
    }

    // Use this function in your existing attributes
    public function getLogoAttribute($value): ?string
    {
        return $this->getFileUrlAttribute($value);
    }

    public function getFaviconAttribute($value): ?string
    {
        return $this->getFileUrlAttribute($value);
    }
}
