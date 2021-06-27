<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteunverified:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto deletion of users with unverified email and phone number';

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
        User::query()
        ->where('role', 'user')
        ->whereNull('phone_number_verified_at')
        ->where('created_at', '<', now()->subDays(7))
        ->delete();
    }
}
