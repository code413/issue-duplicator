<?php

namespace App\Http\Controllers;

use App\Repositories\GithubRepositories;

class FlushRepositoriesController extends Controller
{
    public function __invoke(GithubRepositories $repositories)
    {
        $repositories->flushForUsername(auth()->user()->username);

        return back();
    }
}
