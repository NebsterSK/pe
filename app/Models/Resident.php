<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $birth_year The birth year of the person, using the in-universe standard of BBY or ABY - Before the Battle of Yavin or After the Battle of Yavin. The Battle of Yavin is a battle that occurs at the end of Star Wars episode IV: A New Hope.
 * @property string $eye_color The eye color of this person. Will be "unknown" if not known or "n/a" if the person does not have an eye.
 * @property string $gender The gender of this person. Either "Male", "Female" or "unknown", "n/a" if the person does not have a gender.
 * @property string $hair_color The hair color of this person. Will be "unknown" if not known or "n/a" if the person does not have hair.
 * @property int $height The height of the person in centimeters.
 * @property int $mass The height of the person in centimeters.
 * @property string $skin_color The skin color of this person.
 * @property int $planet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Planet $planet
 * @method static \Database\Factories\ResidentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereEyeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereHairColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident wherePlanetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereSkinColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resident whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Resident extends Model
{
    /** @use HasFactory<\Database\Factories\ResidentFactory> */
    use HasFactory;

    // Relations
    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }
}
