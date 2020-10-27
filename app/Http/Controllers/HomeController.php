<?php

namespace App\Http\Controllers;

use App\Repositories\GithubRepositories;

class HomeController extends Controller
{
    public function index(GithubRepositories $repositories)
    {
        return view(
            'home.index',
            [
                'repositories' => $repositories->getByUsername(auth()->user()->username)
            ]
        );
    }
}
