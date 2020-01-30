<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class MakeTreeOutput.
 */
class MakeTreeOutput extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make tree.txt output of project directory.';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dcas:make-tree-output';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Generating project files tree listing.');
        exec('tree -h -f -I "bootstrap|bower|storage|docs|vendor*|wiki|data|node_modules|*.md|_ide_helper.php|*.txt|*lock*" > tree.txt');
        $this->info('Project files tree listing generated.');
    }
}
