<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $diameter
 * @property int $rotation_period
 * @property int $orbital_period
 * @property string $gravity
 * @property int $population
 * @property string $climate
 * @property string $terrain
 * @property int $surface_water
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PlanetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereClimate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereDiameter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereGravity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereOrbitalPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereRotationPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereSurfaceWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereTerrain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Planet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Planet extends Model
{
    /** @use HasFactory<\Database\Factories\PlanetFactory> */
    use HasFactory;

    // Relations
//    public function residents(): HasMany
//    {
//        return $this->hasMany(Resident::class);
//    }
}
