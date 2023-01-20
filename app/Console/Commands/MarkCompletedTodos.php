<?php

namespace App\Console\Commands;

use App\Jobs\UpdateTodos as JobsUpdateTodos;
use App\Models\Todo;
use Illuminate\Console\Command;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;


class MarkCompletedTodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todos:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark completed all to-dos!';

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
        // Chunking so we don't ran out of memory!
        Todo::where('completed', false)
            ->chunkById(200, function ($todos) {
                JobsUpdateTodos::dispatchSync($todos);
            }); 
    }
}
