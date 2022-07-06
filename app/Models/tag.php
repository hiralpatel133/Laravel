<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    public $tablename = 'taggable';

    public function post(){
        return $this->morphedByMany(post::class,'taggable')->withTimestamps();
    }

    public function comments(){
        return $this->morphedByMany(comment::class, 'taggable')->withTimestamps();
    }
}
