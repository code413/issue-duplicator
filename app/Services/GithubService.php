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

    public function repositoryIssues($repository)
    {
        return $this->client->api('issue')->all(
            $this->extractRepositoryUser($repository),
            $this->extractRepositoryName($repository),
            array('state' => 'open')
        );
    }

    public function repositoryLabels($repository)
    {
        return $this->client->api('issue')->labels()->all(
            $this->extractRepositoryUser($repository),
            $this->extractRepositoryName($repository),
        );
    }

    public function createIssue($repository, $attributes)
    {
        $this->client->api('issue')->create(
            $this->extractRepositoryUser($repository),
            $this->extractRepositoryName($repository),
            $attributes
        );
    }

    public function createLabel($repository, $attributes)
    {
        $this->client->api('issue')->labels()->create(
            $this->extractRepositoryUser($repository),
            $this->extractRepositoryName($repository),
            $attributes
        );
    }

    public function syncIssues($from, $to){
        $issues = $this->repositoryIssues($from);

        foreach ($issues as $issue) {
            $labels = [];

            foreach ($issue['labels'] ?? [] as $label) {
                $labels[] = $label['name'];
            }

            $this->createIssue(
                $to,
                [
                    'title' => $issue['title'],
                    'body' => $issue['body'],
                    'labels' => $labels
                ]
            );
        }

        return $issues;
    }

    public function syncLabels($from, $to)
    {
        $labels = $this->repositoryLabels($from);

        foreach ($labels as $label) {
            $this->createLabel(
                $to,
                [
                    'name' => $label['name'],
                    'description' => $label['description'] ?? '',
                    'color' => $label['color'] ?? null,
                ]
            );
        }
    }

    protected function extractRepositoryUser($repository)
    {
        return explode('/', $repository)[0] ?? null;
    }

    protected function extractRepositoryName($repository)
    {
        return explode('/', $repository)[1] ?? null;
    }
}
