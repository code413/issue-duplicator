<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login/github', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('login/github/callback', [LoginController::class, 'handleProviderCallback']);
