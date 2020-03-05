<?php

namespace App\Providers;

use Github\Client;
use App\Services\GitHub\GitHub;
use Illuminate\Support\ServiceProvider;

class GitHubServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $client = new Client();

            $client->authenticate(config('services.github.token'), null, Client::AUTH_HTTP_TOKEN);

            return $client;
        });

        $this->app->singleton(GitHub::class, function () {
            $client = app(Client::class);

            return new GitHub($client);
        });
    }
}
