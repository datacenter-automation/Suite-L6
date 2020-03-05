<?php

namespace App\Providers;

use App\Events\FileUploaded;
use App\Listeners\DecryptFile;
use App\Listeners\EncryptFile;
use App\Listeners\LoggingListener;
use App\Events\FileDownloadRequested;
use Illuminate\Auth\Events\Registered;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageLogged::class         => [
            LoggingListener::class,
        ],
        FileUploaded::class          => [
            EncryptFile::class,
        ],
        FileDownloadRequested::class => [
            DecryptFile::class,
        ],
        Registered::class            => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
