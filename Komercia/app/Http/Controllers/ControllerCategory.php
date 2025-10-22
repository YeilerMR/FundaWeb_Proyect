<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use Illuminate\Http\Request;


class ControllerCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data= Category::all();
        return response()->json([
        'message' => 'Categoría creada correctamente',
        'data' => $data
    ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $data= Category::all();
        return view('prueba',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'dsc_nombre' => 'required|string|max:255',
        'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $folder = 'Category' . str_replace(' ', '_', strtolower($request->nombre));

    $path = $request->file('imagen')->store($folder, 'public');

    $url = Storage::url($path); 

    $category = new Category();
    $category->dsc_nombre = $request->dsc_nombre;
    $category->dsc_imagen = $url;

    $category->save();

     return response()->json([
        'message' => 'Categoría creada correctamente',
        'data' => $category
    ], 201);
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
}
