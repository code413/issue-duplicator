<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            [
                'github_id' => $githubUser->getId()
            ]
        );

        $user->update(
            [
                'name' => $githubUser->getName(),
                'email' => $githubUser->getEmail(),
                'avatar' => $githubUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect()->intended('/');
    }
}
