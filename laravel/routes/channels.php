<?php

use App\Like;
use App\OurEvent;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{postId}', function ($user,$postId) {
    /*return (int) $user->id === (int) $comment->user_id;*/
    # check if the currently authenticated user is the owner of the event
    return (int) $user->id === (int) $postId;
});
