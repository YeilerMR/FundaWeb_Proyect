<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commerce;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CommerceController extends Controller
{
    public function index()
    {
        $commerces = Commerce::with('categories')->get();
        return view('admin.commerce.index', compact('commerces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.commerce.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $commerce = Commerce::findOrFail($id);
        return view('admin.commerce.form', compact('commerce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $commerce = Commerce::findOrFail($id);
        ImageService::delete($commerce->dsc_imagen_destacada);
        $commerce->delete();

        return back()->with('success', 'Comercio eliminado correctamente.');
    }
}
