<?php

namespace App\Http\Controllers;

use App\Repositories\GithubRepositories;

class HomeController extends Controller
{
    public function index(GithubRepositories $repositories)
    {
        if(request('setup_action')){
            $repositories->flushForUsername(auth()->user()->username);
        }

        return view(
            'home.index',
            [
                'repositories' => $repositories->getByUsername(auth()->user()->username)
            ]
        );
    }
}
