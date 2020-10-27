<?php

namespace App\Providers;

use Github\Client;
use Illuminate\Support\ServiceProvider;

class GithubServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function($app){
            $client = new Client();

            $auth = $app->make('auth')->guard();

            if($auth->check()){
                $client->authenticate($auth->user()->token, null, Client::AUTH_ACCESS_TOKEN);
            }

            return $client;
        });
    }
}
