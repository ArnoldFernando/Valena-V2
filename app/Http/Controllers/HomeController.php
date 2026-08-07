<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\News;
use App\Models\Product;
use App\Models\TouristSpot;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'products'   => Product::latest('id')->take(4)->get(),
            'facilities' => Facility::latest('id')->take(3)->get(),
            'spots'      => TouristSpot::latest('id')->take(3)->get(),
            'news'       => News::latest('date')->take(3)->get(),
        ]);
    }
}
