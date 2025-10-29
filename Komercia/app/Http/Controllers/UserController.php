<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
         return view('landing.Login.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    // Crear usuario (el hashing se hace automáticamente por el cast)
    $usuario = User::create([
        'dsc_username'      => $request->dsc_username,
        'dsc_correo'        => $request->dsc_correo,
        'dsc_contrasenha'   => $request->dsc_contrasenha,  // <- Hasheado automáticamente
        'id_rol'            => 2, // Si tienes rol por defecto, ajústalo
        'fec_creacion'      => now(),
        'fec_modificacion'  => now(),
    ]);

    // Redirección con mensaje
    return redirect() ->route('landing.login.form')->with('success', 'Usuario creado exitosamente.');
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
