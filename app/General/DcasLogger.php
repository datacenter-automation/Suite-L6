<?php

namespace App\General;

use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Crypt;

class DcasLogger extends Logger
{

    /**
     * Write a message to the log.
     *
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    protected function writeLog($level, $message, $context)
    {
        $this->fireLogEvent($level, $message = $this->formatMessage($message), $context);

        $message = Crypt::encrypt($message);
        $context = Crypt::encrypt($context);

        $this->logger->{$level}($message, [$context]);
    }
}
