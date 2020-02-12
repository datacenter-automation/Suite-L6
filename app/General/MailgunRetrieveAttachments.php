<?php

namespace App\General;

use App\Email;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Psr7\Response;
use Mailgun\Mailgun;

class MailgunRetrieveAttachments
{

    /**
     * @var \GuzzleHttp\Client
     */
    private static Client $client;

    /**
     * @var array
     */
    public static array $attachments = [];

    /**
     * @var array
     */
    public static array $storage_locations = [];

    /**
     * @return \GuzzleHttp\Client
     */
    private static function client()
    {
        static::$client = new Client([
            'auth' => [
                'api',
                env('MAILGUN_SECRET'),
            ],
        ]);

        return static::$client;
    }

    /**
     * @return \Mailgun\Mailgun
     */
    private static function init()
    {
        self::client();

        foreach (Email::all() as $email) {
            if (! is_null($email->attachments())) {
                array_push(static::$attachments, $email->attachments());
            }
        }

        return Mailgun::create(env('MAILGUN_SECRET'));
    }

    /**
     * @return array
     */
    public static function get()
    {
        self::init();

        foreach (static::$attachments as $attachment) {
            $url = $attachment->url;
            $saveAs = storage_path('attachments') . "/{$attachment->name}";
            $email = Email::find($attachment->id);

            if (! \File::exists($saveAs)) {
                try {
                    self::$client->request('GET', $url, ['sink' => $saveAs]);

                    array_push(static::$storage_locations, $saveAs);

                    $email->attachments_synced = now();
                    $email->save();
                } catch (\Exception $e) {
                    // ...
                }
            }
        }

        return static::$storage_locations;
    }
}
