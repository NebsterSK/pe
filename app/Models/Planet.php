<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $diameter The diameter of this planet in kilometers.
 * @property int $rotation_period The number of standard hours it takes for this planet to complete a single rotation on its axis.
 * @property int $orbital_period The number of standard days it takes for this planet to complete a single orbit of its local star.
 * @property string $gravity A number denoting the gravity of this planet, where "1" is normal or 1 standard G. "2" is twice or 2 standard Gs. "0.5" is half or 0.5 standard Gs.
 * @property int $population
 * @property string $climate The climate of this planet. Comma separated if diverse.
 * @property string $terrain The terrain of this planet. Comma separated if diverse.
 * @property int $surface_water The percentage of the planet surface that is naturally occurring water or bodies of water.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Resident> $residents
 * @property-read int|null $residents_count
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
    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }
}
