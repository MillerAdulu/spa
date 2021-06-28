<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\AccountDeletionNotice;

class NotifyUsersWithIncompleteProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifyuserswithincomplete:profile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto deletion notice to users with incomplete profile';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usertonotify = User::query()
        ->where('role', 'user')
        ->whereNull('profile_updated_at')
        ->where('created_at', '<', now()->subDays(30))
        ->get();

        foreach ($usertonotify as $user) {
            $user->notify(new AccountDeletionNotice());
        }
        
    }
}