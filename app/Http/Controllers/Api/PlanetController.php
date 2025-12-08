<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planet;
use Illuminate\Http\JsonResponse;

class PlanetController extends Controller
{
    public function largest(): JsonResponse
    {
        $planets = Planet::orderBy('diameter', 'desc')->limit(10)->get(['name', 'diameter']);

        return response()->json($planets);
    }
}
