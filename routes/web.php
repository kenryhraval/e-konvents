<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TakenController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AttendanceController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

Route::middleware('auth')->group(function() {
    Route::resource('items', ItemController::class);
    Route::resource('events', EventController::class);
    Route::resource('users', UserController::class);
    
    Route::post('/duties/{event}', [DutyController::class, 'store'])->name('duties.store');
    Route::delete('/duties/{duty}', [DutyController::class, 'destroy'])->name('duties.destroy');
    
    Route::post('/absences', [AbsenceController::class, 'store'])->name('absences.store');
    Route::put('/absences/{absence}', [AbsenceController::class, 'update'])->name('absences.update');
    Route::delete('/absences/{absence}', [AbsenceController::class, 'destroy'])->name('absences.destroy');
    
    Route::post('/taken/{item}', [TakenController::class, 'store'])->name('taken.store');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
});

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

