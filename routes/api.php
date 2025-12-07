<?php

use App\Http\Controllers\Api\LogbookController;

Route::resource('/logbook/entries', LogbookController::class)->only(['index', 'store'])->names('logbook.entries');
//Route::get('/logbook/entries', [LogbookController::class, 'index'])->name('logbook.entries.index');
//Route::post('/logbook/entries', [LogbookController::class, 'store'])->name('logbook.entries.store');
