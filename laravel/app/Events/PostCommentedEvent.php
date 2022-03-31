<?php

namespace App\Events;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCommentedEvent   implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $id;
    public $post;
    public $postId;
    public $interacted_type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$message,$post,$interacted_type)
    {
        $this->user = $user;
        $this->message = $user->name.$message;
        $this->id = $user->id;
        $this->post = $post;
        $this->postId = $post->user_id;
        $this->interacted_type = $interacted_type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      
        return new PrivateChannel('user.'.$this->user->id);
        
    }
}
