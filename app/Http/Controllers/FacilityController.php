<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        return view('facilities.index', [
            'facilities' => Facility::orderByDesc('id')->get(),
        ]);
    }
}
