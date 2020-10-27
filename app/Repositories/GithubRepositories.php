<?php

namespace App\Repositories;

use App\Services\GithubService;
use Illuminate\Support\Facades\Cache;

class GithubRepositories
{
    protected $github;

    public function __construct(GithubService $github){
        $this->github = $github;
    }

    public function getByUsername($username)
    {
        return Cache::remember(
            "users.{$username}.repositories",
            now()->addMinutes(10),
            function () {
                return $this->github->repositories();
            }
        );
    }
}
