<?php

declare(strict_types=1);

/*
 * This file is part of Laravel GitHub.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | GitHub Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like. Note that the 6 supported authentication methods are:
    | "application", "jwt", "none", "password", "private", and "token".
    |
    */

    'connections' => [

        // backoff, cache, version, enterprise
        'main' => [
            'method'  => 'token',
            'token'   => env('GITHUB_TOKEN'),
            'backoff' => true,
            'cache'   => true,
        ],

        'app' => [
            'method'       => 'application',
            'clientId'     => 'your-client-id',
            'clientSecret' => 'your-client-secret',
        ],

        'jwt' => [
            'method' => 'jwt',
            'token'  => 'your-jwt-token',
        ],

        'private' => [
            'method'  => 'private',
            'appId'   => 'your-github-app-id',
            'keyPath' => 'your-private-key-path',
        ],

        'password' => [
            'method'   => 'password',
            'username' => 'your-username',
            'password' => 'your-password',
        ],

        'none' => [
            'method' => 'none',
        ],

    ],

];
