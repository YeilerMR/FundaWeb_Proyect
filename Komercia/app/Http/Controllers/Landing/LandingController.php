<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\Slider;

class LandingController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id_slider', 'desc')->get();
        $shops = Commerce::with('categories')
        ->orderBy('id_comercio', 'desc')
        ->take(3)
        ->get();
        $categories = Category::withCount('commerces')->get();
        
        return view('landing.index', compact('sliders', 'shops', 'categories'));
    }

    public function commerces(){
        $categories = Category::withCount('commerces')->get();
        $selectedCategory = null;
        $commerces = Commerce::with('categories')->latest('id_comercio')->get();
        $totalCommerces = Commerce::count();

        return view('landing.commerces', compact('categories', 'commerces', 'selectedCategory', 'totalCommerces'));
    }

    public function commercesByCategory($id){
        $categories = Category::withCount('commerces')->get();
        $selectedCategory= Category::findOrFail($id);
        $commerces = $selectedCategory->commerces()->with('categories')->get();
        $totalCommerces = Commerce::count();

        return view('landing.commerces', compact('categories', 'commerces', 'selectedCategory', 'totalCommerces'));
    }
}
