<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory, Taggable;

    protected $fillable = ['title', 'content', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comment()
    {
        return $this->morphMany(comment::class, 'comment')->latest();
    }

    public function image(){
        return $this->morphOne(postImage::class,'image');
    }
}
