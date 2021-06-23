<?php

namespace App\Console;

use App\Console\Commands\DeleteUnverifiedUsers;
use App\Console\Commands\DeleteUsersWithIncompleteProfile;
use App\Console\Commands\NotifyUsersWithIncompleteProfile;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DeleteUnverifiedUsers::class,
        DeleteUsersWithIncompleteProfile::class,
        NotifyUsersWithIncompleteProfile::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) // see docs and implement handling outputs for production
    {
        $schedule->command('deleteunverified:users')->dailyAt('23:00');
        $schedule->command('notifyuserswithincomplete:profile')->dailyAt('23:00');
        $schedule->command('deleteuserswithincomplete:profile')->dailyAt('23:00');
        
        // $schedule->command('deleteunverified:users')->cron('* 0 * * *');
        // $schedule->command('notifyuserswithincomplete:profile')->cron('* 0 * * *');
        // $schedule->command('deleteuserswithincomplete:profile')->cron('* 0 * * *');
       
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
