<?php

namespace App\Mailboxes;

use BeyondCode\Mailbox\InboundEmail;
use App\Models\Email as ReceivedMail;

class MailgunTestMailbox
{
    public function __invoke(InboundEmail $email)
    {
        ReceivedMail::create([
            'sender'  => $email->from(),
            'subject' => $email->subject(),
            'body'    => $email->text(),
        ]);
    }
}
