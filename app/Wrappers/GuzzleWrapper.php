<?php

namespace App\Wrappers;

use App\Contracts\HttpClient;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;

class GuzzleWrapper implements HttpClient
{

    /**
     * @var \GuzzleHttp\Client
     */
    private Client $client;

    /**
     * GuzzleWrapper constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $uri, array $options = []): ResponseInterface
    {
        return $this->client->get($uri, $options);
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $uri, array $options = []): ResponseInterface
    {
        return $this->client->post($uri, $options);
    }
}
