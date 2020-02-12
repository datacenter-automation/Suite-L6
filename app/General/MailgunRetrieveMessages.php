<?php

namespace App\General;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Mailgun\Mailgun;

class MailgunRetrieveMessages
{

    /**
     * @var \Mailgun\Model\Event\EventResponse
     */
    protected static $events;

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
     * @var array
     */
    public static array $messages = [];

    /**
     * @var \GuzzleHttp\Client
     */
    private static Client $client;

    /**
     * @var string
     */
    private static string $cacheIdentifier;

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
        return Mailgun::create(env('MAILGUN_SECRET'));
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
     * @return static
     */
    public static function get()
    {
        $keys = $urls = $mail = [];

        foreach (static::events()->getItems() as $item) {
            if ($item->getEvent() === "stored") {
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
     * @return array
     */
    public static function keys()
    {
        return static::$keys;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function urls()
    {
        return static::$urls;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function mail()
    {
        return static::$mail;
    }

    /**
     * @return array
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

        $eachPromise = new EachPromise($promises, [
            'concurrency' => 4,
            'fulfilled'   => function (Response $response) {
                if ($response->getStatusCode() == 200) {
                    array_push(static::$messages, ['response' => json_decode($response->getBody(), true)]);
                }

                Cache::put(static::$cacheIdentifier, static::$messages, now()->addMinute(5));
            },
            'rejected'    => function ($reason) {
                //
            },
        ]);

        $eachPromise->promise()->wait();

        return new static;
    }

    private static function unsetMessageNotFoundKeys(): void
    {
        $keyIndexMax = count(static::keys()) - 1;
        $messageIndexMax = count(static::getMessages());
        $keyMessageDifference = $keyIndexMax - $messageIndexMax;

        if ($keyMessageDifference !== 0) {
            foreach (range($keyIndexMax, $messageIndexMax) as $index) {
                unset(static::$keys[$index]);
            }
        }
    }

    /**
     * @todo
     */
    public static function convert()
    {
        self::unsetMessageNotFoundKeys();;

        $fetchedMessages = self::combinedKeysAndMessages();

        dd($fetchedMessages);
    }

    public static function sendToDatabase()
    {
        // todo
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected static function combinedKeysAndMessages(): Collection
    {
        $messageCollection = collect(['message' => static::$messages]);
        $keyCollection = collect(['keys' => static::$keys]);

        $fetchedMessages = $messageCollection->put('keys', $keyCollection);

        return $fetchedMessages;
    }
}
