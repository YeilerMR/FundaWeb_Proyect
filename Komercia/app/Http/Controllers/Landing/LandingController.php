<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Slider;

class LandingController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id_slider', 'desc')->get();
        return view('landing.index', compact('sliders'));
    }
}
