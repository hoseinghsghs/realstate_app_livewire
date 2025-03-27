<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFloorSell extends Model
{

    protected $table = 'property_floorsell';
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
