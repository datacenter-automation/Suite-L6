<?php

namespace App\MailProcessing;

use Mailsceptor\MailsceptorHook;

class DefaultHook extends MailsceptorHook
{

    /**
     * Process mail.
     *
     * @return bool
     */
    public function process()
    {
        return true;
        /*
         * @todo
         */
        //// public property containing the email message
        //$email = $this->swiftMessage;
        //
        //$hooksMayContinue = false;
        //
        //if ($email->getSubject() == 'You are pretty.') {
        //    $hooksMayContinue = true;
        //}
        //
        //// Allow the rest of the internal hooks to continue
        //return $hooksMayContinue;
    }
}
