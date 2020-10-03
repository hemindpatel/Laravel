<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class UpdatePostCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:update_post_counter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Counter of Post Table';

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
     * @return mixed
     */
    public function handle()
    {
        $post = Post::findOrFail(1);
        if($post){
            $counter = $post->count;
            $post->count = $counter + 1;
            $post->save();
        }
    }
}
