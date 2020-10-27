<?php

namespace App\Models;

use Github\Client;
use Github\ResultPager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateGithubProfile($profile){
        $this->update(
            [
                'name' => $profile->getName(),
                'username' => $profile->getNickname(),
                'email' => $profile->getEmail(),
                'avatar' => $profile->getAvatar(),
                'token' => $profile->token ?? null,
                'refresh_token' => $profile->refreshToken ?? null,
            ]
        );
    }
}
