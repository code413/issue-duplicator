<?php

namespace App\Http\Controllers;

use Github\Client;

class HomeController extends Controller
{
    public function index(){
        return view('home.index', ['repositories' => $this->getRepositories()]);
    }

    protected function getRepositories(){
        if(!auth()->check()){
            return null;
        }

        $client = new Client();

        $user = auth()->user();

        $client->authenticate($user->token, null, Client::AUTH_ACCESS_TOKEN );

        /*  $repositories = Cache::remember("users.{$user->username}.repositories.6", now()->addMinutes(10), function() use($client){
              return $client->currentUser()->repositories('private');
          });*/

        return $client->currentUser()->repositories('all');
    }
}
