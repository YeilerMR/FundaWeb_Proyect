<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\CommerceImage;
use App\Models\ContactMessage;
use App\Models\EmailCommerce;
use App\Models\Product;
use App\Models\Slider;
use App\Services\BrevoService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

    public function commerces()
    {
        $categories = Category::withCount('commerces')->get();
        $selectedCategory = null;
        $commerces = Commerce::with('categories')->latest('id_comercio')->get();
        $totalCommerces = Commerce::count();

        return view('landing.commerces', compact('categories', 'commerces', 'selectedCategory', 'totalCommerces'));
    }

    public function commercesByCategory($id)
    {
        $categories = Category::withCount('commerces')->get();
        $selectedCategory = Category::findOrFail($id);
        $commerces = $selectedCategory->commerces()->with('categories')->get();
        $totalCommerces = Commerce::count();

        return view('landing.commerces', compact('categories', 'commerces', 'selectedCategory', 'totalCommerces'));
    }

    public function search(Request $request)
    {
        $q = trim($request->get('q', ''));

        if ($q === '') {
            $commerces = Commerce::with('categories')->latest('id_comercio')->get();
            $products = collect();
        } else {
            $term = "%{$q}%";

            $commerces = Commerce::with('categories')
                ->where('dsc_nombre', 'like', $term)
                ->orWhere('dsc_descripcion', 'like', $term)
                ->get();

            $products = Product::with('commerce')
                ->where('dsc_nombre', 'like', $term)
                ->orWhere('dsc_descripcion', 'like', $term)
                ->get();
        }

        $totalCommerces = $commerces->count();
        $totalProducts = $products->count();

        return view('landing.search_results', compact(
            'commerces',
            'totalCommerces',
            'totalProducts',
            'products',
            'q'
        ));
    }
}
