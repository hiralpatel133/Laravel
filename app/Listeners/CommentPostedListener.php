<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\commentpostedonpost;
use App\Mail\commentpost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CommentPostedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        //echo '<pre>';print_r($event);exit;
        Mail::to($event->comment->user)->queue(
            new commentpost($event->comment)
        );

        commentpostedonpost::dispatch();
    }
}
