<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Requests\postComment;
use App\Models\post;

class postCommentController extends Controller
{

    public function index(post $post)
    {
        return $post->comment()->with('user')->get();
    }

    public function store(post $post,postComment $request)
    {   
        //echo '<pre>';print_r($post->user);exit;
        $comment = $post->comment()->create([
            'comment' => $request->input('comment'),
            'user_id' => $request->user()->id
            
        ]);

        event(new CommentPosted($comment));

        $request->session()->flash('status', 'Comment was created!');

        return redirect()->back();
    }
}
