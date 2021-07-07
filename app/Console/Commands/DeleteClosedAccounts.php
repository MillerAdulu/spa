<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteClosedAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteclosed:accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto deletion of closed accounts';

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
    public function handle() //add deletion of all related data
    {
        User::query()
        ->where('role', 'user')
        ->where('deleted_at', '<', now()->subYears(7))
        ->delete();
    }
}
