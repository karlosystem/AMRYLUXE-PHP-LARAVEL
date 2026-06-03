<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    // Show all
    public function index()
    {
        $sliders = DB::table('banners')->latest()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos del formulario
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'subtitulo'    => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'link'         => 'required|url',
            'imagen'       => 'required|image|mimes:jpeg,png,jpg|max:2048', // La imagen es obligatoria al crear
        ]);

        $imageName = null;

        // 2. Procesamos la subida de la imagen si el archivo existe
        if ($request->hasFile('imagen')) { // Cambiado de 'image' a 'imagen'

            // CORRECCIÓN: Usar 'imagen' en ambas partes de esta línea
            $imageName = time() . '.' . $request->imagen->extension();

            // CORRECCIÓN: Usar 'imagen' también aquí
            $request->imagen->move(public_path('front/assets/images/slider'), $imageName);
        }

        // 3. Creamos el registro en la base de datos usando el modelo Slider
        Slider::create([
            'titulo'       => $request->titulo,
            'subtitulo'    => $request->subtitulo,
            'descripcion' => $request->descripcion,
            'imagen'       => $imageName, // Guardamos solo el nombre del archivo
            'link'        => $request->link,
            'status'      => 1,
        ]);

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('admin.sliders.index')->with('success', 'Banner creado correctamente.');
    }

    public function update(Request $request, Slider $slider)
    {
        // 1. Validamos los datos. La imagen es 'nullable' porque puede no cambiarse
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'subtitulo'   => 'required|string|max:255',
            'descripcion' => 'required|string',
            'link'        => 'required|url',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Variable para mantener el nombre de la imagen actual
        $imageName = $slider->imagen;

        // 3. Lógica si el usuario sube una nueva imagen
        if ($request->hasFile('imagen')) {

            // Definimos la ruta de la imagen vieja
            $oldPath = public_path('front/assets/images/slider/' . $slider->imagen);

            // Eliminamos el archivo físico anterior si existe
            if (file_exists($oldPath) && !empty($slider->imagen)) {
                @unlink($oldPath);
            }

            // Procesamos y guardamos la nueva imagen
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('front/assets/images/slider'), $imageName);
        }

        // 4. Actualizamos el modelo con los nuevos datos
        $slider->update([
            'titulo'      => $request->titulo,
            'subtitulo'   => $request->subtitulo,
            'descripcion' => $request->descripcion,
            'link'        => $request->link,
            'imagen'      => $imageName, // Nombre nuevo o el anterior
            'status'      => $request->status ?? 1,
        ]);

        // 5. Redirección con mensaje de éxito
        return redirect()->route('admin.sliders.index')->with('success', 'Banner actualizado correctamente.');
    }

    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $slider = Slider::findOrFail($id);

        // 2. Definimos la ruta de la imagen
        $imagePath = public_path('front/assets/images/slider/' . $slider->imagen);

        // 3. Verificamos si el archivo existe y lo eliminamos del servidor
        if (file_exists($imagePath) && !empty($slider->imagen)) {
            @unlink($imagePath); // Elimina el archivo físico
        }

        // 4. Eliminamos el registro de la base de datos
        $slider->delete();

        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.sliders.index')->with('success', 'Banner e imagen eliminados con éxito.');
    }

    public function edit($id)
    {
        // Buscamos el banner por ID o fallamos si no existe
        $banner = Slider::findOrFail($id);

        // Retornamos la vista con los datos del banner
        return view('admin.sliders.edit', compact('banner'));
    }
}
