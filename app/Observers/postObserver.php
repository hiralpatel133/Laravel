<?php

namespace App\Observers;

use App\Models\post;
use Illuminate\Support\Facades\Cache;

class postObserver
{
    
    public function updating(post $post)
    {
        Cache::forget("post-detail-$post->id");
    }
}
