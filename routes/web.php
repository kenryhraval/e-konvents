<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EventController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); 
})->name('home'); // to link it with blade

Route::resource('items', ItemController::class);
Route::resource('events', EventController::class);

