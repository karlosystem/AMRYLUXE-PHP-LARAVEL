<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pagina;
use Illuminate\Support\Facades\File;

class PaginasController extends Controller
{
    public function index()
    {
        $paginas = Pagina::orderBy('id', 'desc')->get();
        return view('admin.paginas.index', compact('paginas'));
    }

    public function create()
    {
        return view('admin.paginas.create');
    }

    public function store(Request $request)
    {
        // 1. Validación rigurosa según la estructura de la tabla
        $request->validate([
            'titulo'           => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:paginas,slug',
            'descripcion'      => 'required|string',
            'primary_image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords'    => 'nullable|string|max:255',
            'status'           => 'required|integer|in:0,1',
        ]);

        // 2. Procesamiento de la Imagen
        $imageName = null;
        if ($request->hasFile('primary_image')) {
            $image = $request->file('primary_image');

            // Nombre descriptivo basado en el slug para SEO
            $imageName = $request->slug . '-' . time() . '.' . $image->getClientOriginalExtension();

            // Ruta específica para páginas
            $destinationPath = public_path('front/assets/images/paginas');

            // Crear el directorio si no existe físicamente
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $image->move($destinationPath, $imageName);
        }

        // 3. Creación del registro en la base de datos
        Pagina::create([
            'titulo'           => $request->titulo,
            'slug'             => $request->slug,
            'descripcion'      => $request->descripcion,
            'imagen'           => $imageName ?? 'default.jpg', // Valor por defecto si no hay imagen
            'meta_title'       => $request->meta_title ?? $request->titulo,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'status'           => $request->status,
        ]);

        // 4. Redirección con mensaje de éxito
        return redirect()->route('admin.paginas.index')
            ->with('success', 'La página ha sido creada correctamente.');
    }

    public function edit($id)
    {
        $pagina = Pagina::findOrFail($id);
        return view('admin.paginas.edit', compact('pagina'));
    }

public function update(Request $request, $id)
{
    $pagina = Pagina::findOrFail($id);

    $request->validate([
        'titulo'      => 'required|string|max:255',
        'slug'        => 'required|string|max:255|unique:paginas,slug,' . $id,
        'descripcion' => 'required',
        'status'      => 'required|in:0,1',
    ]);

    $imageName = $pagina->imagen;

    if ($request->hasFile('primary_image')) {
        // Eliminar imagen anterior si existe físicamente
        $oldPath = public_path('front/assets/images/paginas/' . $pagina->imagen);
        if (File::exists($oldPath) && !empty($pagina->imagen)) {
            File::delete($oldPath);
        }

        $image = $request->file('primary_image');
        $imageName = $request->slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('front/assets/images/paginas'), $imageName);
    }

    $pagina->update([
        'titulo'           => $request->titulo,
        'slug'             => $request->slug,
        'descripcion'      => $request->descripcion,
        'imagen'           => $imageName,
        'meta_title'       => $request->meta_title,
        'meta_description' => $request->meta_description,
        'meta_keywords'    => $request->meta_keywords,
        'status'           => $request->status,
    ]);

    return redirect()->route('admin.paginas.index')->with('success', 'Página actualizada con éxito.');
}

    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $pagina = Pagina::findOrFail($id);

        // 2. Definimos la ruta de la imagen
        $imagePath = public_path('front/assets/images/paginas/' . $pagina->imagen);

        // 3. Verificamos si el archivo existe y lo eliminamos del servidor
        if (file_exists($imagePath) && !empty($pagina->imagen)) {
            @unlink($imagePath); // Elimina el archivo físico
        }

        // 4. Eliminamos el registro de la base de datos
        $pagina->delete();

        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.paginas.index')->with('success', 'Pagina e imagen eliminados con éxito.');
    }
}
