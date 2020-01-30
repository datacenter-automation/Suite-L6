<?php

namespace App\Traits;

trait ProgressBarOutput
{

    /**
     * @param \Countable $countable
     * @param callable   $callback
     */
    public function runProcess(\Countable $countable, callable $callback)
    {
        $bar = $this->output->createProgressBar(count($countable));

        $bar->start();

        foreach ($countable as $item) {
            call_user_func($callback, $item);

            $bar->advance();
        }

        $bar->finish();

        $this->line('');
    }
}
