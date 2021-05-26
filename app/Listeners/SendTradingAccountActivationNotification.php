<?php

namespace App\Listeners;

use App\Events\TradingAccountActivation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\TradingAccountActivated;

class SendTradingAccountActivationNotification implements ShouldQueue
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
     * @param  TradingAccountActivation  $event
     * @return void
     */
    public function handle(TradingAccountActivation $event)
    {
        //dd($event);
        $user = $event->user;
        $user->notify(new TradingAccountActivated($user));

    }
}
