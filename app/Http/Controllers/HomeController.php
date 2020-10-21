<?php

namespace App\Http\Controllers;

use Github\Client;
use Github\ResultPager;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', ['repositories' => $this->getRepositories()]);
    }

    protected function getRepositories()
    {
        if (!auth()->check()) {
            return null;
        }

        $user = auth()->user();

        return Cache::remember(
            "users.{$user->username}.repositories",
            now()->addMinutes(10),
            function () {
                $client = new Client();

                $client->authenticate(auth()->user()->token, null, Client::AUTH_ACCESS_TOKEN);

                $paginator = new ResultPager($client);

                return $paginator->fetchAll($client->currentUser(), 'repositories', ['all']);
            }
        );
    }
}
