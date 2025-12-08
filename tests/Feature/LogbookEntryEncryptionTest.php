<?php

use App\Models\Api\Logbook\Entry;

test('attributes stored in database are encrypted', function () {
    $decryptedData = Entry::factory()->make();

    $entry = Entry::factory()->create([
        'mood' => $decryptedData->mood,
        'weather' => $decryptedData->weather,
        'latitude' => $decryptedData->latitude,
        'longitude' => $decryptedData->longitude,
        'supplies_for_days' => $decryptedData->supplies_for_days,
        'note' => $decryptedData->note,
    ]);

    $encryptedData = DB::table('logbook_entries')->where('id', $entry->id)->first();

    expect($encryptedData->mood)->not->toBe($decryptedData->mood->value)
        ->and($encryptedData->weather)->not->toBe($decryptedData->weather->value)
        ->and($encryptedData->latitude)->not->toBe($decryptedData->latitude)
        ->and($encryptedData->longitude)->not->toBe($decryptedData->longitude)
        ->and($encryptedData->supplies_for_days)->not->toBe($decryptedData->supplies_for_days)
        ->and($encryptedData->note)->not->toBe($decryptedData->note);
})->group('logbook');

test('attributes are decrypted correctly', function () {
    $decryptedData = Entry::factory()->make();

    $entry = Entry::factory()->create([
        'mood' => $decryptedData->mood,
        'weather' => $decryptedData->weather,
        'latitude' => $decryptedData->latitude,
        'longitude' => $decryptedData->longitude,
        'supplies_for_days' => $decryptedData->supplies_for_days,
        'note' => $decryptedData->note,
    ]);

    expect($entry->id)->not->toBeNull();

    $reloadedEntry = Entry::query()->find($entry->id);

    expect($reloadedEntry->mood)->toBe($decryptedData->mood)
        ->and($reloadedEntry->weather)->toBe($decryptedData->weather)
        ->and($reloadedEntry->latitude)->toBe($decryptedData->latitude)
        ->and($reloadedEntry->longitude)->toBe($decryptedData->longitude)
        ->and($reloadedEntry->supplies_for_days)->toBe($decryptedData->supplies_for_days)
        ->and($reloadedEntry->note)->toBe($decryptedData->note);
})->group('logbook');
