<?php

use App\Http\Controllers\Api\LogbookController;

Route::post('/logbook/entries', LogbookController::class)->name('logbook.entries.store');
