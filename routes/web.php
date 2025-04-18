<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); 
})->name('home'); // to link it with blade

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

