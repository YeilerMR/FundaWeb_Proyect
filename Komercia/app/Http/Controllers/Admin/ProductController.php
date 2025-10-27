<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commerce;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index($commerceId)
    {
        $commerce = Commerce::findOrFail($commerceId);

        $products = Product::where('id_comercio', $commerceId)
            ->with('commerce')
            ->get();

        return view('admin.products.index', compact('products', 'commerce'));
    }

    public function create($commerceId)
    {
        $commerce = Commerce::findOrFail($commerceId);
        return view('admin.products.form', compact('commerce'));
    }

    public function store(Request $request, $commerceId)
    {
        $this->validateProduct($request);

        $product = new Product();
        $product->id_comercio = $commerceId;
        $this->saveProduct($product, $request);

        return redirect()
            ->route('admin.commerce.products.index', $commerceId)
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $commerce = Commerce::findOrFail($product->id_comercio);

        return view('admin.products.form', compact('product', 'commerce'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validateProduct($request, $isUpdate = true);

        $this->saveProduct($product, $request);

        return redirect()
            ->route('admin.commerce.products.index', $product->id_comercio)
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->dsc_imagen_destacada) {
            ImageService::delete($product->dsc_imagen_destacada);
        }

        Storage::disk('public')->deleteDirectory(
            "commerces/{$product->id_comercio}/products/{$product->id_producto}"
        );

        $commerceId = $product->id_comercio;
        $product->delete();

        return redirect()
            ->route('admin.commerce.products.index', $commerceId)
            ->with('success', 'Producto eliminado correctamente.');
    }

    private function validateProduct(Request $request, $isUpdate = false)
    {
        $rules = [
            'dsc_nombre'      => 'required|string|max:255',
            'precio'          => 'required|numeric|min:0',
            'dsc_descripcion' => 'nullable|string',
        ];

        if (!$isUpdate) {
            $rules['dsc_imagen_destacada'] = 'required|image|mimes:jpeg,png,webp|max:2048';
        } elseif ($request->hasFile('dsc_imagen_destacada')) {
            $rules['dsc_imagen_destacada'] = 'image|mimes:jpeg,png,webp|max:2048';
        }

        $request->validate($rules);
    }

    private function saveProduct(Product $product, Request $request)
    {
        $product->fill([
            'dsc_nombre'      => $request->dsc_nombre,
            'dsc_descripcion' => $request->dsc_descripcion,
            'precio'          => $request->precio,
        ]);

        $product->save();

        if ($request->hasFile('dsc_imagen_destacada')) {
            if ($product->dsc_imagen_destacada) {
                ImageService::delete($product->dsc_imagen_destacada);
            }

            $path = ImageService::upload(
                $request->file('dsc_imagen_destacada'),
                "commerces/{$product->id_comercio}/products/{$product->id_producto}"
            );

            $product->update(['dsc_imagen_destacada' => $path]);
        }
    }


    /* ==============================
       GALERÍA
       ============================== */

    public function gallery($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $commerce = Commerce::findOrFail($product->id_comercio);

        return view('admin.products.gallery', compact('product', 'commerce'));
    }

    public function galleryStore($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image) {
                    ImageService::delete($image->dsc_url);
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = ImageService::upload(
                    $file,
                    "commerces/{$product->id_comercio}/products/{$product->id_producto}"
                );

                ProductImage::create([
                    'id_producto' => $product->id_producto,
                    'dsc_url'     => $path,
                    'dsc_alt'     => $product->dsc_nombre,
                ]);
            }
        }

        return back()->with('success', 'Imágenes actualizadas correctamente.');
    }
}
