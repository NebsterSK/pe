<?php

namespace App\Http\Controllers;

use App\Models\Api\Logbook\Entry;
use App\Models\Planet;
use App\Models\Resident;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $planetsCount = Planet::count();
        $residentsCount = Resident::count();
        $logbookEntriesCount = Entry::count();

        return view('dashboard')->with([
            'planetsCount' => $planetsCount,
            'residentsCount' => $residentsCount,
            'logbookEntriesCount' => $logbookEntriesCount,
        ]);
    }
}
