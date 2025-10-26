<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Commerce;
use App\Models\Slider;

class LandingController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id_slider', 'desc')->get();
        $shops = Commerce::orderBy('id_comercio', 'desc')->take(3)->get();
        
        return view('landing.index', compact('sliders', 'shops'));
    }
}
