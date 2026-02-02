<?php

namespace App\Console\Commands;

use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Console\Command;
use App\Models\User;

class SendWelcomeEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:send-welcome {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send welcome email to all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users =User::all();

        if($users->isEmpty()){
            $this->warn('No users found');
            return;
        }

        foreach($users as $user){
            if($this->option('queue')){
                SendWelcomeEmailJob::dispatch($user->email, $user->name);
            }
            else{
                dispatch_sync(new SendWelcomeEmailJob($user->email, $user->name));
            }
        }
        $this->info('welcome email sent');
    }
}
