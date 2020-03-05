<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TestMail extends Mailable
{
    public $body;

    public $sender;

    public $subject;

    /**
     * TestMail constructor.
     *
     * @param $sender
     * @param $subject
     * @param $body
     */
    public function __construct($sender, $subject, $body)
    {
        $this->sender = $sender;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * @return \App\Mail\TestMail
     */
    public function build()
    {
        return $this->from($this->sender)->subject($this->subject)->markdown('emails.tests.testmail', ['body' => $this->body]);
    }
}
