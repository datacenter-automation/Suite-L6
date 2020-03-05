<?php

namespace App\Mailboxes;

use App\Email as ReceivedMail;
use BeyondCode\Mailbox\InboundEmail;

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
