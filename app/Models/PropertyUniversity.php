<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PropertyUniversity extends Pivot
{
    protected $guarded = [];
    protected $hidden  = ['pivot'];
    //casts
    protected $casts = [
        'property_id'   => 'integer',
        'university_id' => 'integer',
    ];

    //relationship
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
