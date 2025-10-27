<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commerce;
use App\Models\Category;
use App\Models\CommerceImage;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommerceController extends Controller
{
    public function index()
    {
        $commerces = Commerce::with('categories')->get();
        return view('admin.commerce.index', compact('commerces'));
    }

    public function create()
    {
        $categories = Category::select('id_categoria as id', 'dsc_nombre as name')->get();
        return view('admin.commerce.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validateCommerce($request);

        $commerce = new Commerce();
        $this->saveCommerce($commerce, $request);

        return redirect()->route('admin.commerce.index')
            ->with('success', 'Comercio creado correctamente.');
    }

    public function edit(string $id)
    {
        $commerce = Commerce::with(['categories', 'phones', 'emails'])->findOrFail($id);
        $categories = Category::select('id_categoria as id', 'dsc_nombre as name')->get();

        $categoriesIds = $commerce->categories->pluck('id_categoria')->toArray();
        $phones = $commerce->phones->pluck('dsc_telefono')->toArray();
        $emails = $commerce->emails->pluck('dsc_correo')->toArray();

        return view('admin.commerce.form', compact(
            'commerce',
            'categories',
            'categoriesIds',
            'phones',
            'emails'
        ));
    }

    public function update(Request $request, string $id)
    {
        $this->validateCommerce($request, $isUpdate = true);

        $commerce = Commerce::findOrFail($id);
        $this->saveCommerce($commerce, $request);

        return redirect()->route('admin.commerce.index')->with('success', 'Comercio actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $commerce = Commerce::findOrFail($id);

        ImageService::delete($commerce->dsc_imagen_destacada);
        Storage::disk('public')->deleteDirectory("commerces/{$commerce->id_comercio}");

        $commerce->delete();

        return back()->with('success', 'Comercio eliminado correctamente.');
    }

    private function validateCommerce(Request $request, $isUpdate = false)
    {
        $rules = [
            'dsc_nombre' => 'required|string|max:255',
            'dsc_descripcion' => 'required|string',
            'dsc_direccion' => 'required|string',
            'dsc_latitud' => 'required',
            'dsc_longitud' => 'required',
            'categories' => 'required|array|min:1',
            'telefonos' => 'required|array|min:1',
            'emails' => 'required|array|min:1',
        ];

        if (!$isUpdate) {
            $rules['dsc_imagen_destacada'] = 'required|image|mimes:jpeg,png,webp|max:2048';
        } else if ($request->hasFile('dsc_imagen_destacada')) {
            $rules['dsc_imagen_destacada'] = 'image|mimes:jpeg,png,webp|max:2048';
        }

        $request->validate($rules);
    }

    private function saveCommerce(Commerce $commerce, Request $request)
    {
        $commerce->fill($request->except(['categories', 'telefonos', 'emails', 'dsc_imagen_destacada']))->save();

        if ($request->hasFile('dsc_imagen_destacada')) {
            if ($commerce->dsc_imagen_destacada) {
                ImageService::delete($commerce->dsc_imagen_destacada);
            }
            $path = ImageService::upload(
                $request->file('dsc_imagen_destacada'),
                "commerces/{$commerce->id_comercio}"
            );
            $commerce->update(['dsc_imagen_destacada' => $path]);
        }

        $commerce->categories()->sync($request->categories);

        $commerce->phones()->delete();
        foreach ($request->telefonos as $phone) {
            $commerce->phones()->create(['dsc_telefono' => $phone]);
        }

        $commerce->emails()->delete();
        foreach ($request->emails as $email) {
            $commerce->emails()->create(['dsc_correo' => $email]);
        }
    }

    /* ==============================
       GALERÍA
       ============================== */

    public function gallery($id)
    {
        $commerce = Commerce::with('gallery')->findOrFail($id);
        return view('admin.commerce.gallery', compact('commerce'));
    }

    public function galleryStore($id, Request $request)
    {
        $commerce = Commerce::findOrFail($id);

        // VALIDACIÓN más flexible
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        /* ===============================
        1. ELIMINAR IMÁGENES MARCADAS
    ================================= */
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = CommerceImage::find($imageId);
                if ($image) {
                    ImageService::delete($image->dsc_url); // elimina del storage
                    $image->delete();                     // elimina de BD
                }
            }
        }

        /* ===============================
        2. SUBIR NUEVAS IMÁGENES
    ================================= */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = ImageService::upload($file, "commerces/{$commerce->id_comercio}/gallery");

                CommerceImage::create([
                    'id_comercio' => $commerce->id_comercio,
                    'dsc_url'     => $path,
                    'dsc_alt'     => $commerce->dsc_nombre,
                ]);
            }
        }

        return back()->with('success', 'Cambios guardados correctamente.');
    }
}
