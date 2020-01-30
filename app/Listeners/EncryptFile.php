<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use SoareCostin\FileVault\Facades\FileVault;

class EncryptFile
{

    /**
     * Handle the event.
     *
     * @param \App\Events\FileUploaded $event
     *
     * @return void
     */
    public function handle(FileUploaded $event)
    {
        FileVault::disk('upload')->encrypt($event->file);
    }
}
