<?php

namespace App\Traits;

trait ManipulateEmailData
{

    /**
     * Output Merged Messages.
     *
     * @return array
     */
    public static function showMergedMessages()
    {
        $duplicateMessages = static::findDuplicateMessages()->toArray();

        $original = array_merge($duplicateMessages[0], $duplicateMessages[1]);
        unset($original["id"], $original["recipients"]);

        $newData = [
            'ids'        => [
                $duplicateMessages[0]["id"],
                $duplicateMessages[1]["id"],
            ],
            'recipients' => [
                $duplicateMessages[0]["recipients"],
                $duplicateMessages[1]["recipients"],
            ],
        ];

        sort($newData['ids']);
        sort($newData['recipients']);

        return $newData + $original;
    }

    /**
     * Find duplicate messages to process.
     *
     * @return mixed
     */
    private static function findDuplicateMessages()
    {
        $emails = static::all();
        $uniqueEmails = $emails->unique('message_id');
        $duplicateEmails = $emails->diff($uniqueEmails);
        $duplicateMessageId = $duplicateEmails->first()->message_id;

        return static::where('message_id', '=', $duplicateMessageId)->get();
    }

    /**
     * Tweak subject to add inbound e-mail account.
     *
     * @return string
     */
    public function manipulateSubject()
    {
        $mailbox = strtoupper(explode('"', str_before($this->recipients, '@'))[1]);
        $trimmedSubject = trim($this->subject, '"');

        return sprintf("[%s] %s", $mailbox, $trimmedSubject);
    }

    /**
     * @todo
     *
     * @return mixed
     */
    public function manipulateMessageHeaders()
    {
        return $this->message_headers;
    }
}
