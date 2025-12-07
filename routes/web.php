<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanetController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/planets', PlanetController::class)->name('planets.index');

    // TODO: Planets, Residents & Logbook
});
