<?php

namespace App\Http\Controllers;
use App\Models\tag;

use Illuminate\Http\Request;

class postTagController extends Controller
{
    //
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        return view('posts.index', [
            'posts' => $tag->post, 
            'most_commented_posts' => [], 
            'mostActive' => [], 
            'mostActiveLastMonth' => []
        ]);
    }
}
