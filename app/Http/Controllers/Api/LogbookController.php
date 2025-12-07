<?php

namespace App\Http\Controllers\Api;

use App\Enums\Mood;
use App\Enums\Weather;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Logbook\Entries\StoreRequest;
use App\Http\Resources\Api\Logbook\EntryResource;
use App\Models\Api\Logbook\Entry;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class LogbookController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $entries = Entry::orderBy('id', 'desc')->get();

        return EntryResource::collection($entries);
    }

    public function store(StoreRequest $request): EntryResource
    {
        $validated = $request->validated();

        try {
            $entry = Entry::create([
                'mood' => Mood::from($validated['mood']),
                'weather' => Weather::from($validated['weather']),
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'supplies_for_days' => $validated['supplies_for_days'],
                'note' => $validated['note'],
            ]);
        } catch (Throwable $e) {
            Log::error('Logbook Entry could not be created', [
                'exception_message' => $e->getMessage(),
                'exception_file' => $e->getFile(),
                'exception_line' => $e->getLine(),
                'user_id' => Auth::user()->id,
            ]);

            abort(Response::HTTP_BAD_REQUEST);
        }

        Log::info('Logbook Entry created', [
            'entry_id' => $entry->id,
            'user_id' => Auth::user()->id,
        ]);

        return new EntryResource($entry);
    }
}
