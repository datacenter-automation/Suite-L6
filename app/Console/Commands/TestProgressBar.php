<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\ProgressBarOutput;

class TestProgressBar extends Command
{
    use ProgressBarOutput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'progressbar:test';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\User::all();

        $bar = $this->output->createProgressBar(count($users));
        $bar->start();

        foreach ($users as $user) {
            sleep(1);

            $bar->advance();
        }

        $bar->finish();

        return true;
    }
}
