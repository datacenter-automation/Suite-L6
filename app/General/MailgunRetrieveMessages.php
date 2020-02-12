<?php

namespace App\General;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use Illuminate\Support\Collection;
use Mailgun\Mailgun;
use GuzzleHttp\Psr7\Response;

class MailgunRetrieveMessages
{

    /**
     * @var \Mailgun\Model\Event\EventResponse
     */
    protected static $events;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $keys;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $urls;

    /**
     * @var \Illuminate\Support\Collection
     */
    public static Collection $mail;

    /**
     * @var \GuzzleHttp\Client
     */
    private static Client $client;

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
            $key = $item->getStorage()['key'];
            $url = $item->getStorage()['url'];

            array_push($keys, $key);
            array_push($urls, $url);

            array_push($mail, ['key' => $key, 'url' => $url]);
        }

        static::$keys = collect($keys);
        static::$urls = collect($urls);

        static::$mail = collect($mail);

        return new static;
    }

    /**
     * @return \Illuminate\Support\Collection
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
     * Get messages.
     *
     * @todo
     */
    public static function messages()
    {
        $promises = [];

        foreach (self::urls() as $url) {
            array_push($promises, static::client()->getAsync($url));
        }

        $eachPromise = new EachPromise($promises, [
            // how many concurrency we are use
            'concurrency' => 4,
            'fulfilled' => function (Response $response) {
                if ($response->getStatusCode() == 200) {
                    //$messages = json_decode($response->getBody(), true);
                    //print_r($messages);
                    print_r($response->getBody()->getContents());
                }
            },
            'rejected' => function ($reason) {
                // handle promise rejected here
            }
        ]);

        $eachPromise->promise()->wait();
    }

    /**
     * @todo
     */
    public static function convert()
    {
        // ...
    }
}
