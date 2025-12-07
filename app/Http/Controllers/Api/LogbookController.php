<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Logbook\Entries\StoreRequest;
use App\Http\Resources\Api\Logbook\EntryResource;
use App\Models\Api\Logbook\Entry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogbookController extends Controller
{
    public function __invoke(StoreRequest $request): EntryResource
    {
        $validated = $request->validated();

        $entry = Entry::create([
            'mood' => $validated['mood'],
            'weather' => $validated['weather'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'supplies_for_days' => $validated['supplies_for_days'],
            'note' => $validated['note'],
        ]);

        Log::info('Logbook Entry created', [
            'entry_id' => $entry->id,
//            'user_id' => Auth::user()->id,
        ]);

        return new EntryResource($entry);
    }
}
