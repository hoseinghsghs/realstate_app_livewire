<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','title','slug','body','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }  
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}