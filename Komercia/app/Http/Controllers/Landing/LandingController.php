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

    public function showCommerce($id)
    {
        $commerce = Commerce::with('categories')->findOrFail($id);
        $category = $commerce->categories->first();

        return view('landing.commerce-detail', compact('commerce', 'category'));
    }

    public function showProducts($id)
    {
        $commerce = Commerce::with('categories')->findOrFail($id);
        $category = $commerce->categories->first();
        $products = Product::where('id_comercio', $id)->get();
        //$products = Product::where('id_comercio', $id)->get();

        return view('landing.commerce-products', compact('commerce', 'category', 'products'));
    }

    public function showGallery($id)
    {
        $commerce = Commerce::with('categories')->findOrFail($id);
        $category = $commerce->categories->first();
        $images = CommerceImage::where('id_comercio', $id)->get();

        return view('landing.commerce-gallery', compact('commerce', 'category', 'images'));
    }

    public function showContact($id)
    {
        $commerce = Commerce::with('categories')->findOrFail($id);
        $category = $commerce->categories->first();
        return view('landing.commerce-contact', compact('commerce', 'category'));
    }

    public function sendContact(Request $request, $id)
    {
        //Validacion
        $validator = Validator::make($request->all(), [
            'dsc_nombre' => 'required|string|max:100',
            'dsc_telefono' => 'required|string|max:20',
            'dsc_correo' => 'required|email|max:100',
            'dsc_mensaje' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $commerce = Commerce::findOrFail($id);
        $emails = EmailCommerce::where('id_comercio', $id)->pluck('dsc_correo')->toArray();

        if (empty($emails)) {
            return back()->withErrors(['correo' => 'Este comercio no tiene correo registrado.'])->withInput();
        }

        ContactMessage::create([
            'id_comercio' => $id,
            'dsc_nombre' => $request->dsc_nombre,
            'dsc_telefono' => $request->dsc_telefono,
            'dsc_correo' => $request->dsc_correo,
            'dsc_mensaje' => $request->dsc_mensaje,
            'fec_envio' => now()->format('Y-m-d H:i:s'),
        ]);

        //Enviar correo con brevo
        $data = $request->only(['dsc_nombre', 'dsc_telefono', 'dsc_correo', 'dsc_mensaje']);
        $data['commerce_name'] = $commerce->dsc_nombre;
        
        $brevo = new BrevoService();
        foreach ($emails as $email) {
            $brevo->sendContactEmail($email, $commerce->dsc_nombre, $data);
        }
        return back()->with('success', 'Tu mensaje ha sido enviado con exito!');
    }
}
