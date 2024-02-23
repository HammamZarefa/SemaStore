<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class checkUserLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userLevel:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user level';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user)
        {
            $user->checkLevelChanges();
        }
        return Command::SUCCESS;
    }
}
