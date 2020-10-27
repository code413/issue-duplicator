<?php

namespace App\Services;

use Github\Client;
use Github\ResultPager;

class GithubService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function repositories()
    {
        $paginator = new ResultPager($this->client);

        return $paginator->fetchAll($this->client->currentUser(), 'repositories', ['all']);
    }
}
