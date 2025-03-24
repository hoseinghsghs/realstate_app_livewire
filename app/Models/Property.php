<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $guarded = [];
    use HasFactory;

    public function scopeActive(Builder $query)
    {
        $query->where('isactive', true);
    }

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

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function features()
    {
        return $this->belongsToMany(Feature::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'property_id');
    }

    public function checkUserWishlist($userId)
    {
        return $this->hasMany(WishList::class)->where('user_id', $userId)->exists();
    }


}