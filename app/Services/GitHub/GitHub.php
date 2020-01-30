<?php

namespace App\Services\GitHub;

use Github\Client;
use Github\ResultPager;
use Illuminate\Support\Collection;

class GitHub
{

    /** @var \Github\Client */
    protected $client;

    /** @var \Github\ResultPager */
    protected $paginator;

    public function __construct(Client $client)
    {
        $this->client = $client;

        $this->paginator = new ResultPager($client);
    }

    public function search(string $for, string $query): Collection
    {
        $api = $this->client->api('search');

        $repos = $this->paginator->fetchAll($api, $for, [$query]);

        return collect($repos);
    }
}
