<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Lockout;
use App\Events\TradingAccountActivation;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendWelcomeEmailNotification;
use App\Listeners\SendGettingStartedEmailNotification;
use App\Listeners\SendTradingAccountActivationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    // /**
    // * Determine if events and listeners should be automatically discovered.
    // *
    // * @return bool
    // */
    // public function shouldDiscoverEvents()
    // {
    //     return true;
    // }

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,

        ],

        Verified::class => [
            SendWelcomeEmailNotification::class,
            SendGettingStartedEmailNotification::class,

        ],
        
       TradingAccountActivation::class => [
            SendTradingAccountActivationNotification::class,

       ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
