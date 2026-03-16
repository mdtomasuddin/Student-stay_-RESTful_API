<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'status'];

    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
        'thumbnail'   => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    //getAvatarAttribute
    public function getThumbnailAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
