<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Facades\File;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::orderBy('id', 'desc')->get();
        return view('admin.marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            'nombre'        => 'required|string|max:160',
            'slug'          => 'required|string|max:200|unique:marcas,slug',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'required|in:0,1',
        ]);

        // 2. Procesamiento de la Imagen
        $imageName = null;
        if ($request->hasFile('primary_image')) {
            $image = $request->file('primary_image');

            // Generar nombre único usando el slug
            $imageName = $request->slug . '-' . time() . '.' . $image->getClientOriginalExtension();

            // Definir ruta de destino
            $destinationPath = public_path('front/assets/images/marcas');

            // Crear carpeta si no existe
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $image->move($destinationPath, $imageName);
        }

        // 3. Guardar en la Base de Datos
        Marca::create([
            'nombre'     => $request->nombre,
            'slug'       => $request->slug,
            'imagen'     => $imageName,
            'status'     => $request->status,
            'prod_count' => 0, // Valor inicial por defecto
        ]);

        return redirect()->route('admin.marcas.index')->with('success', '¡Marca creada con éxito!');
    }

    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('admin.marcas.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);

        // 1. Validar datos
        $request->validate([
            'nombre'        => 'required|string|max:160',
            'slug'          => 'required|string|max:200|unique:marcas,slug,' . $id,
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'required|in:0,1',
        ]);

        $imageName = $marca->imagen;

        // 2. Gestionar nueva imagen
        if ($request->hasFile('primary_image')) {
            $image = $request->file('primary_image');

            // Eliminar imagen vieja si existe
            $oldPath = public_path('front/assets/images/marcas/' . $marca->imagen);
            if (File::exists($oldPath) && !empty($marca->imagen)) {
                File::delete($oldPath);
            }

            // Guardar nueva imagen
            $imageName = $request->slug . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/marcas'), $imageName);
        }

        // 3. Actualizar modelo
        $marca->update([
            'nombre' => $request->nombre,
            'slug'   => $request->slug,
            'imagen' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.marcas.index')->with('success', 'Marca actualizada exitosamente.');
    }

    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $marca = Marca::findOrFail($id);

        // 2. Definimos la ruta de la imagen
        $imagePath = public_path('front/assets/images/marcas/' . $marca->imagen);

        // 3. Verificamos si el archivo existe y lo eliminamos del servidor
        if (file_exists($imagePath) && !empty($marca->imagen)) {
            @unlink($imagePath); // Elimina el archivo físico
        }

        // 4. Eliminamos el registro de la base de datos
        $marca->delete();

        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.marcas.index')->with('success', 'Marca e imagen eliminados con éxito.');
    }
}
