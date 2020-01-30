<?php

namespace App\Listeners;

use App\Events\FileDownloadRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecryptFile
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileDownloadRequested  $event
     * @return void
     */
    public function handle(FileDownloadRequested $event)
    {
        //
    }
}
