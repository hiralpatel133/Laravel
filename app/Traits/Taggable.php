<?php

namespace App\Traits;

use App\Models\tag;

trait Taggable{

    public function tags(){
        return $this->morphToMany(tag::class,'taggable')->withTimestamps();
    }

}