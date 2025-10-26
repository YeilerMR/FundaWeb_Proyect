<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dsc_titulo' => 'required|string|max:100',
            'dsc_imagen' => 'required|image|max:2048',
        ]);

        $path = ImageService::upload($request->file('dsc_imagen'), 'sliders');

        Slider::create([
            'dsc_titulo' => $request->dsc_titulo,
            'dsc_descripcion' => $request->dsc_subtitulo,
            'dsc_enlace' => $request->dsc_enlace,
            'dsc_imagen' => $path,
        ]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider creado correctamente');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.form', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dsc_titulo' => 'required|string|max:100',
            'dsc_imagen' => 'nullable|image|max:2048',
        ]);

        $slider = Slider::findOrFail($id);

        $data = [
            'dsc_titulo' => $request->dsc_titulo,
            'dsc_descripcion' => $request->dsc_subtitulo,
            'dsc_enlace'      => $request->dsc_enlace,
        ];

        if ($request->hasFile('dsc_imagen')) {
            ImageService::delete($slider->dsc_imagen);
            $data['dsc_imagen'] = ImageService::upload($request->file('dsc_imagen'), 'sliders');
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider actualizado correctamente.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        ImageService::delete($slider->dsc_imagen);
        $slider->delete();

        return back()->with('success', 'Slider eliminado correctamente.');
    }
}
