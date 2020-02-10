<?php

namespace App\Providers;

use App\Mailboxes\PostmarkTestMailbox;
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
        Mailbox::from('74eefc5e44320f361884ae8c8810ea6b@inbound.postmarkapp.com', PostmarkTestMailbox::class);
    }
}
