<?php

namespace App\Mailboxes;

use BeyondCode\Mailbox\InboundEmail;

class PostmarkTestMailbox
{
    public function __invoke(InboundEmail $email)
    {
        return true;
    }
}
