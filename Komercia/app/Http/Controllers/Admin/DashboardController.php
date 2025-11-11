<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commerce;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class DashboardController extends Controller
{
    public function index()
    {
        // GLOBAL STATS
        $totalCommerces = Commerce::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalSliders = Slider::count();

        // RECENT COMMERCES
        $recentCommerces = Commerce::with('categories')
            ->orderByDesc('id_comercio')
            ->take(5)
            ->get();

        // COMMERCES BY CATEGORY        
        $commercesByCategory = Category::withCount('commerces')
            ->orderByDesc('commerces_count')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalCommerces',
            'totalCategories',
            'totalProducts',
            'totalSliders',
            'recentCommerces',
            'commercesByCategory'
        ));
    }
}
