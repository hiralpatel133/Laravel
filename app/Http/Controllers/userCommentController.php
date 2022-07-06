<?php

namespace App\Http\Controllers;

use App\Http\Requests\userComment;
use App\Models\User;

class userCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user, userComment $request)
    {
        $user->comment()->create([
            'comment' => $request->input('comment'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
