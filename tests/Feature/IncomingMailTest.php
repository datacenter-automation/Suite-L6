<?php

namespace Tests\Feature;

use App\Email as ReceivedMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class IncomingMailTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        config(['mail.driver' => 'mailgun', 'app.name' => 'Datacenter Automation Suite Test']);
    }

    /** @test * */
    function incoming_mail_is_saved_to_the_mails_table()
    {
        // Given: we have an e-mail﻿
        $email = new TestMail($from = 'sender@example.com', $subject = 'Test E-mail', $body = 'Some example text in the body');

        // When: we receive that e-mail
        Mail::to('incoming@mailbox-demo.elementalfusion.online')->send($email);

        // Then: we assert the e-mails (meta)data was stored
        $this->assertCount(1, ReceivedMail::all());

        tap(ReceivedMail::first(), function ($mail) use ($from, $subject, $body) {
            $this->assertSame($from, $mail->from());
            $this->assertSame($subject, $mail->subject());
            $this->assertStringContainsString($body, $mail->body());
        });
    }
}
