<?php

namespace App\Http\Resources\Api\Logbook;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Api\Logbook\Entry
 */
class EntryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'mood' => $this->mood->value,
            'weather' => $this->weather->value,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'supplies_for_days' => $this->supplies_for_days,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
