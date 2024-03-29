<?php

namespace App\Events;

use App\Models\User;
use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
    * User that sent the message
    *
    * @var User
    */
    public $user;

    /**
    * Message details
    *
    * @var Chat
    */
    public $chat;

    /**
    * Create a new event instance.
    *
    * @return void
    */
    public function __construct(User $user, Chat $chat)
    {
        $this->user = $user;
        $this->chat = $chat;
    }

    
    /**
    * Get the data to broadcast.
    *
    * @return array
    */
    public function broadcastWith()
    {
        return [
            'first_name' => $this->user->first_name,
            $this->chat
        ];
    }

    /**
    * Get the channels the event should broadcast on.
    *
    * @return \Illuminate\Broadcasting\Channel|array
    */
    public function broadcastOn()
    {
        return new PrivateChannel('chats');
    }
}
