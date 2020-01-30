<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class MakePHPDevelopmentReports.
 */
class MakePHPDevelopmentReports extends Command
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make PHP coding development reports.';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dcas:make-phpdev-reports {disable?}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // curl --silent localhost:4040/api/tunnels > ngrok-tunnels.json

        if ($this->argument('disable') || env('PHP_DEV_REPORTS') === false) {
            $this->info('PHPCS & PHPMD reports skipped.');

            return false;
        }

        $this->info('Generating PHP development reports (PHPCS, PHPMD).');

        exec('vendor/bin/phpcs -s --standard=phpcs-ruleset.xml');
        exec('vendor/bin/phpmd app,config,routes html phpmd-ruleset.xml > public/phpmd.html');

        exec('curl --silent localhost:4040/api/tunnels > ngrok-tunnels.json');

        $tunnel = json_decode(file_get_contents('ngrok-tunnels.json'), true)['tunnels'][0]['public_url'];

        file_put_contents($file = 'public/phpcs.xml', str_replace('<?xml version="1.0" encoding="UTF-8"?>', '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="' . $tunnel . '/phpcs.xsl"?>', file_get_contents($file)));

        $this->info('PHPCS & PHPMD reports generated.');
    }
}
