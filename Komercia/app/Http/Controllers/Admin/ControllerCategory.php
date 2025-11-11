<?php

namespace App\Http\Controllers\Admin;

use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class ControllerCategory extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin.category.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'dsc_nombre' => 'required|string|max:255',
            'dsc_imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $folder = 'Category' . str_replace(' ', '_', strtolower($request->nombre));

        $url = $url = ImageService::upload($request->file('dsc_imagen'), $folder);

        $category = new Category();
        $category->dsc_nombre = $request->dsc_nombre;
        $category->dsc_imagen = $url;

        $category->save();

        return back()->with('success', 'Categoría registrada correctamente.');
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
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación: nombre requerido, imagen opcional
        $request->validate([
            'dsc_nombre' => 'required|string|max:255',
            'dsc_imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = Category::findOrFail($id);

        $data = [
            'dsc_nombre' => $request->dsc_nombre,
        ];

        if ($request->hasFile('dsc_imagen')) {

            ImageService::delete($category->dsc_imagen);

            $folder = 'Category' . str_replace(' ', '_', strtolower($request->nombre));

            $data['dsc_imagen'] = ImageService::upload($request->file('dsc_imagen'), $folder);
        }

        $category->update($data);

        return redirect()->route('admin.category.index')->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        ImageService::delete($category->dsc_imagen);
        $category->delete();
        return back()->with('success', 'Categoría eliminado correctamente.');
    }
}
