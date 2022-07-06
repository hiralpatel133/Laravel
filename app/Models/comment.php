<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory, Taggable;

    protected $fillable = ['comment','user_id'];
    protected $hidden = ['deleted_at','comment_type','comment_id'];

    public function post(){
        return $this->morphTo(post::class,'comment');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
