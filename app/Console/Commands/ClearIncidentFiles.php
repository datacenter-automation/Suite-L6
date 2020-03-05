<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearIncidentFiles extends Command
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear incident files in ./storage/app/incidents/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dcas:clear-incident-files';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->confirm('Clear error incident files?')) {
            $this->info('Error incident files have NOT been cleared!');
        } else {
            $this->warn('Clearing error incident files now...');

            \File::cleanDirectory(storage_path('app/incident'));

            $this->info('Done.');
        }
    }
}
