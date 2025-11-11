<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\Slider;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('landing.Login.log');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $usuario = User::where('dsc_username', $request->username)->first();

    if ($usuario && Hash::check($request->password, $usuario->dsc_contrasenha)) {
      

       $sliders = Slider::orderBy('id_slider', 'desc')->get();
        $shops = Commerce::with('categories')
        ->orderBy('id_comercio', 'desc')
        ->take(3)
        ->get();
        $categories = Category::withCount('commerces')->get();
        
        return view('landing.index', compact('sliders', 'shops', 'categories'));
    }

    return back()->withErrors(['password' => 'Usuario o contraseña incorrecta']);
}
}