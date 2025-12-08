<?php

use App\Http\Controllers\Api\LogbookController;
use App\Http\Controllers\Api\PlanetController;

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::resource('/logbook/entries', LogbookController::class)->only(['index', 'store'])->names('logbook.entries');

    Route::get('/planets/largest', [PlanetController::class, 'largest'])->name('planets.largest');
});
