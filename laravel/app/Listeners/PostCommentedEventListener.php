<?php

namespace App\Listeners;

use App\Events\PostCommentedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostCommentedEventListener
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
     * @param  PostCommentedEvent  $event
     * @return void
     */
    public function handle(PostCommentedEvent $event)
    {
       return $event;
    }
}
