<?php

namespace App\Providers;

use App\Mailboxes\MailgunTestMailbox;
use BeyondCode\Mailbox\Facades\Mailbox;
use Illuminate\Support\ServiceProvider;

class MailboxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Mailbox::from('incoming@mailbox-demo.elementalfusion.online', MailgunTestMailbox::class);
        Mailbox::catchAll(MailgunTestMailbox::class);
    }
}
