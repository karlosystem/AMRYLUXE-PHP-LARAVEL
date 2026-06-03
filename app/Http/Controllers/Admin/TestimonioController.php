<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Testimonio;
use Illuminate\Support\Facades\File;

class TestimonioController extends Controller
{
    // Show all
    public function index()
    {
        $testimonios = DB::table('testimonios')->latest()->get();
        return view('admin.testimonios.index', compact('testimonios'));
    }

    public function create()
    {
        return view('admin.testimonios.create');
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos del formulario
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'cargo'    => 'required|string|max:255',
            'comentario'  => 'required|string',
            'imagen'       => 'required|image|mimes:jpeg,png,jpg|max:2048', // La imagen es obligatoria al crear
        ]);

        $imageName = null;

        // 2. Procesamos la subida de la imagen si el archivo existe
        if ($request->hasFile('imagen')) { // Cambiado de 'image' a 'imagen'

            // CORRECCIÓN: Usar 'imagen' en ambas partes de esta línea
            $imageName = time() . '.' . $request->imagen->extension();

            // CORRECCIÓN: Usar 'imagen' también aquí
            $request->imagen->move(public_path('front/assets/images/testimonios'), $imageName);
        }

        // 3. Creamos el registro en la base de datos usando el modelo Slider
        Testimonio::create([
            'nombre'       => $request->nombre,
            'cargo'    => $request->cargo,
            'comentario' => $request->comentario,
            'imagen'       => $imageName, // Guardamos solo el nombre del archivo
            'status'      => 1,
        ]);

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('admin.testimonio.index')->with('success', 'Testimonio creado correctamente.');
    }

    public function edit($id)
    {
        // Buscamos el banner por ID o fallamos si no existe
        $testimonio = Testimonio::findOrFail($id);

        // Retornamos la vista con los datos del banner
        return view('admin.testimonios.edit', compact('testimonio'));
    }

    public function update(Request $request, Testimonio $testimonio)
    {
        // 1. Validamos los datos. La imagen es 'nullable' porque puede no cambiarse
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'cargo'   => 'required|string|max:255',
            'comentario' => 'required|string',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Variable para mantener el nombre de la imagen actual
        $imageName = $testimonio->imagen;

        // 3. Lógica si el usuario sube una nueva imagen
        if ($request->hasFile('imagen')) {

            // Definimos la ruta de la imagen vieja
            $oldPath = public_path('front/assets/images/testimonios/' . $testimonio->imagen);

            // Eliminamos el archivo físico anterior si existe
            if (file_exists($oldPath) && !empty($testimonio->imagen)) {
                @unlink($oldPath);
            }

            // Procesamos y guardamos la nueva imagen
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('front/assets/images/testimonios'), $imageName);
        }

        // 4. Actualizamos el modelo con los nuevos datos
        $testimonio->update([
            'nombre'      => $request->nombre,
            'cargo'   => $request->cargo,
            'comentario' => $request->comentario,
            'imagen'      => $imageName, // Nombre nuevo o el anterior
            'status'      => $request->status ?? 1,
        ]);

        // 5. Redirección con mensaje de éxito
        return redirect()->route('admin.testimonio.index')->with('success', 'Testimonio actualizado correctamente.');
    }

    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $testimonio = Testimonio::findOrFail($id);

        // 2. Definimos la ruta de la imagen
        $imagePath = public_path('front/assets/images/testimonio/' . $testimonio->imagen);

        // 3. Verificamos si el archivo existe y lo eliminamos del servidor
        if (file_exists($imagePath) && !empty($testimonio->imagen)) {
            @unlink($imagePath); // Elimina el archivo físico
        }

        // 4. Eliminamos el registro de la base de datos
        $testimonio->delete();

        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.testimonio.index')->with('success', 'Testimonio e imagen eliminados con éxito.');
    }

}