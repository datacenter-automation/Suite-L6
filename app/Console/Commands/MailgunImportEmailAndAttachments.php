<?php

namespace App\Console\Commands;

use App\Email;
use Illuminate\Console\Command;

class MailgunImportEmailAndAttachments extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailgun:import-email-and-attachments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import E-mail & Attachments from Mailgun.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param \App\Email $email
     *
     * @return array
     */
    public function handle(Email $email)
    {
        $email::importEmailAndAttachments();

        return [
            'code'    => 200,
            'message' => 'Successfully imported e-mails and attachments.',
        ];
    }
}
