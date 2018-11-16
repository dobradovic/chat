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

class ChatEvent implements ShouldBroadcast //ChatEvent must implement ShouldBroadcast for broadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message; //public key
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,User $user)
    {
         $this->message = $message;
         $this->user = $user->name;
         $this->dontBroadcastToCurrentUser(); //Exclude the current user from receiving the broadcast.
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat'); //channel name
    }
}
