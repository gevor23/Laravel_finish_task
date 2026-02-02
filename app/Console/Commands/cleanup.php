<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class cleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:cleanup {--delete} {--archive}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup overdue completed posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Post::where('status', 'completed')
            ->where('created_at', '<', now());

        $count = $query->count();

        if($count === 0){
            $this->info('No overdue completed posts found');
            return Command::SUCCESS;
        }
        if($this->option('delete')){
            $query->delete();
            $this->info("Deleted {$count} overdue completed posts");
            return Command::SUCCESS;
        }
        if($this->option('archive')){
            $query->update(['archived_at' => now()]);
            $this->info("Archived {$count} overdue completed posts");
            return Command::SUCCESS;
        }
        $this->warn('Please specify an option --delete or --archive');
        return Command::FAILURE;
    }
}
