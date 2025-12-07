<?php

namespace App\Http\Requests\Api\Logbook\Entries;

use App\Enums\Mood;
use App\Enums\Weather;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mood' => [
                'required',
                'string',
                Rule::in(Mood::cases()),
            ],
            'weather' => [
                'required',
                'string',
                Rule::in(Weather::cases()),
            ],
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
            'supplies_for_days' => [
                'required',
                'integer',
                'min:0',
            ],
            'note' => [
                'required',
                'string',
                'max:65535',
            ],
        ];
    }
}
