<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

Route::middleware('auth')->group(function() {
    Route::resource('items', ItemController::class);
    Route::resource('events', EventController::class);
    Route::resource('users', UserController::class);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

