<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TradingAccountActivation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->message =  "Hi {$user->first_name}, you're now set to trade";
    }

    /**
    * Get the data to broadcast.
    *
    * @return array
    */
    public function broadcastWith()
    {
        return ['message' => $this->user->message];
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
