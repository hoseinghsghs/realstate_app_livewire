<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{  protected $table='features';
    protected $guarded=[];

    public function properties()
    {
         return $this->belongsToMany(Property::class)->withTimestamps();
    }
    use HasFactory;
}