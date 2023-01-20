<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateTodos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $todos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($todos)
    {
        $this->todos = $todos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        foreach ($this->todos as $todo) {
            $todo->update(['completed' => true]);
        }
    }
}
