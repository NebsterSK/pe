<?php

use App\Http\Controllers\Api\LogbookController;

Route::resource('/logbook/entries', LogbookController::class)->only(['index', 'store'])->middleware('auth:sanctum')->names('logbook.entries');
