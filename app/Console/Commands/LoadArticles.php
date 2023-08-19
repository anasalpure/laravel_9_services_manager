<?php

namespace App\Console\Commands;

use App\Jobs\LoadUserArticles;
use App\Models\User;
use Illuminate\Console\Command;

class LoadArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load articles from the active services';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if($user->source && count($user->keywords))
                LoadUserArticles::dispatch($user)
                    ->onQueue("articles");
        }
    }
}
