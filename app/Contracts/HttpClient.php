<?php

namespace App\Contracts;

use Psr\Http\Message\ResponseInterface;

interface HttpClient
{

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $uri, array $options = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $uri, array $options = []): ResponseInterface;
}
