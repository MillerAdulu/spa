<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\TelescopeServiceProvider;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Telescope::ignoreMigrations();

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);

        //$this->app->bind('App\Contracts\MustVerifyPhoneNumber', 'App\Models\User');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
