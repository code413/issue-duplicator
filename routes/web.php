<?php

use App\Http\Controllers\CopyIssuesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::view('login', 'auth.login')->name('login');
    Route::get('login/github', [LoginController::class, 'redirectToProvider'])->name('login.github');
    Route::get('login/github/callback', [LoginController::class, 'handleProviderCallback']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('issues/copy', CopyIssuesController::class)->name('issues.copy');
});
