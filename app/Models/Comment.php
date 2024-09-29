<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'rating',
        'body',
        'approved',
    ];

    public function getRatingNameAttribute()
    {
        switch ($this->rating) {
            case 5:
                return "عالی";
                break;
            case 4:
                return "خیلی خوب";
                break;
            case 3:
                return "خوب";
                break;
            case 2:
                return "متوسط";
                break;
            case 1:
                return "ضعیف";
                break;
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function children()
    {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }
}
