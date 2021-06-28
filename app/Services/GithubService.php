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
            ['state' => 'open', 'direction' => 'asc']
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

    public function deleteLabel($repository, $name)
    {
        $this->client->api('issue')->labels()->deleteLabel(
            $this->extractRepositoryUser($repository),
            $this->extractRepositoryName($repository),
            $name
        );
    }

    public function flushLabels($repository)
    {
        $destinationLabels = collect($this->repositoryLabels($repository));

        foreach ($destinationLabels as $label) {
            $this->deleteLabel($repository, $label['name']);
        }
    }

    public function syncIssues($from, $to, $ignoreLabels = false)
    {
        $issues = $this->repositoryIssues($from);

        foreach ($issues as $issue) {
            $labels = [];

            foreach ($issue['labels'] ?? [] as $label) {
                $labels[] = $label['name'];
            }

            $attributes = [
                'title' => $issue['title'],
                'body' => $issue['body'],
            ];

            if(!$ignoreLabels){
                $attributes['labels'] = $labels;
            }

            $this->createIssue(
                $to,
                $attributes
            );
        }

        return $issues;
    }

    public function syncLabels($from, $to, $aggressive = false)
    {
        $labels = collect($this->repositoryLabels($from));

        if ($aggressive) {
            $this->flushLabels($to);
        } else {
            $labels = $this->filterExistingLabels($labels, $to);
        }

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

        return $labels->all();
    }

    protected function filterExistingLabels($labels, $repository){
        $destinationLabels = collect($this->repositoryLabels($repository));

        return $labels->filter(
            function ($label) use ($destinationLabels) {
                return !$destinationLabels->pluck('name')->contains($label['name']);
            }
        );
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
