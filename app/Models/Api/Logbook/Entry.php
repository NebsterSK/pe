<?php

namespace App\Models\Api\Logbook;

use App\Enums\Mood;
use App\Enums\Weather;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Mood $mood
 * @property Weather $weather
 * @property float $latitude
 * @property float $longitude
 * @property int $supplies_for_days Number of days until supplies run out.
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Api\Logbook\EntryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereMood($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereSuppliesForDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entry whereWeather($value)
 * @mixin \Eloquent
 */
class Entry extends Model
{
    /** @use HasFactory<\Database\Factories\Api\Logbook\EntryFactory> */
    use HasFactory;

    protected $table = 'logbook_entries';

    protected $casts = [
        'mood' => Mood::class,
        'weather' => Weather::class,
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
