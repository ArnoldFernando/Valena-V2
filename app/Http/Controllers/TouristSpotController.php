<?php

namespace App\Http\Controllers;

use App\Models\TouristSpot;
use Illuminate\View\View;

class TouristSpotController extends Controller
{
    public function index(): View
    {
        return view('tourist-spots.index', [
            'spots' => TouristSpot::orderByDesc('id')->get(),
        ]);
    }
}
