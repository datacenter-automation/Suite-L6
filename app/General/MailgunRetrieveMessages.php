<?php

namespace App\General;

use App\Email;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Mailgun\Mailgun;

class MailgunRetrieveMessages
{

    const MAX_STORAGE_IN_DAYS = 1;

    const CACHE_RECORDS_FOR_MINUTES = 5;

    /**
     * @var array
     */
    public static array $keys;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $urls;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $mail;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $messages;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $fetchedMessages;

    /**
     * @var \Mailgun\Model\Event\EventResponse
     */
    protected static $events;

    /**
     * @var \GuzzleHttp\Client
     */
    private static Client $client;

    /**
     * @var string
     */
    private static string $cacheIdentifier;

    /**
     * @return static
     */
    public static function get()
    {
        $keys = $urls = $mail = [];

        foreach (static::events()->getItems() as $item) {
            $isStored = $item->getEvent() === "stored";
            $isValidEmail = (Carbon::instance($item->getEventDate()))->addDays(self::MAX_STORAGE_IN_DAYS)->gte(now());

            if ($isStored && $isValidEmail) {
                $key = $item->getStorage()['key'];
                $url = $item->getStorage()['url'];

                array_push($keys, $key);
                array_push($urls, $url);

                array_push($mail, ['key' => $key, 'url' => $url]);
            }
        }

        static::$keys = $keys;
        static::$urls = collect($urls);

        static::$mail = collect($mail);

        static::$cacheIdentifier = sprintf("cache_mail_%s", static::$keys[0]);

        return new static;
    }

    /**
     * @return \Mailgun\Model\Event\EventResponse
     */
    private static function events()
    {
        self::$events = static::init()->events()->get(env('MAILGUN_DOMAIN'));

        return self::$events;
    }

    /**
     * @return \Mailgun\Mailgun
     */
    private static function init()
    {
        return Mailgun::create(env('MAILGUN_SECRET'));
    }

    /**
     * @return array
     */
    public static function keys()
    {
        return static::$keys;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function mail()
    {
        return static::$mail;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getMessages()
    {
        return static::$messages;
    }

    /**
     * Get messages.
     *
     * @return static
     */
    public static function messages()
    {
        if (Cache::has(static::$cacheIdentifier)) {
            static::$messages = Cache::get(static::$cacheIdentifier);

            return new static;
        }

        $promises = [];

        foreach (self::urls() as $url) {
            array_push($promises, static::client()->getAsync($url));
        }

        static::$messages = collect();

        $eachPromise = new EachPromise($promises, [
            'concurrency' => 4,
            'fulfilled'   => function (Response $response) {
                if ($response->getStatusCode() == 200) {
                    $message = json_decode($response->getBody(), true);

                    $retrievedMessageMap = new MailgunMessage($message['Message-Id'], $message['recipients'], $message['sender'], $message['from'], $message['X-Envelope-From'], $message['Subject'] ?? 'BLANK SUBJECT', $message['body-plain'], $message['stripped-text'], $message['stripped-signature'], $message['body-html'] ?? '', $message['stripped-html'], $message['attachments'], $message['message-headers'], $message['content-id-map'],);

                    static::$messages->push($retrievedMessageMap);
                }

                Cache::put(static::$cacheIdentifier, static::$messages, now()->addMinute(self::CACHE_RECORDS_FOR_MINUTES));
            },
            'rejected'    => function ($reason) {
                //
            },
        ]);

        $eachPromise->promise()->wait();

        return new static;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function urls()
    {
        return static::$urls;
    }

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
     * @return static
     */
    public static function convert()
    {
        static::$fetchedMessages = self::combinedKeysAndMessages();

        return new static;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected static function combinedKeysAndMessages(): Collection
    {
        $messageCollection = static::$messages;
        $keyCollection = collect(['keys' => static::$keys]);

        return $keyCollection->put('messages', $messageCollection);
    }

    /**
     * @todo
     */
    public static function sendToDatabase()
    {
        $fetchedMessagesMinusKeys = static::$fetchedMessages->forget('keys')->toArray();

        foreach ($fetchedMessagesMinusKeys as $fMMK) {
            foreach ($fMMK as $message) {
                try {
                    Email::create($message->toArray());
                } catch (\Exception $e) {
                    // ...
                }
            }
        }

        return [
            'code'    => 200,
            'message' => 'Success.',
        ];
    }
}
