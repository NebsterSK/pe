<?php

namespace App\Models\Api\Logbook;

use App\Enums\Mood;
use App\Enums\Weather;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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

    // Attributes (for encryption)
    protected function mood(): Attribute
    {
        return Attribute::make(
            get: fn ($value): Mood => Mood::from(Crypt::decrypt($value)),
            set: fn (Mood $value) => Crypt::encrypt($value->value),
        );
    }

    protected function weather(): Attribute
    {
        return Attribute::make(
            get: fn ($value): Weather => Weather::from(Crypt::decrypt($value)),
            set: fn (Weather $value) => Crypt::encrypt($value->value),
        );
    }

    protected function latitude(): Attribute
    {
        return Attribute::make(
            get: fn ($value): float => (float) Crypt::decrypt($value),
            set: fn (float $value) => Crypt::encrypt($value),
        );
    }

    protected function longitude(): Attribute
    {
        return Attribute::make(
            get: fn ($value): float => (float) Crypt::decrypt($value),
            set: fn (float $value) => Crypt::encrypt($value),
        );
    }

    protected function suppliesForDays(): Attribute
    {
        return Attribute::make(
            get: fn ($value): int => (int) Crypt::decrypt($value),
            set: fn (int $value) => Crypt::encrypt($value),
        );
    }

    protected function note(): Attribute
    {
        return Attribute::make(
            get: fn ($value): string => Crypt::decrypt($value),
            set: fn (string $value) => Crypt::encrypt($value),
        );
    }
}
