<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\TipoCategoria;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    public function index()
    {
        //$categorias = DB::table('categorias')->latest()->get();
        // $categorias = Categoria::latest()->get();
        // $categorias = DB::table('categorias')->latest('created_at')->get();
        // $categorias = Categoria::orderBy('id', 'desc')->get();

        $categorias = Categoria::join('tipo_categorias', 'categorias.tipo_id', '=', 'tipo_categorias.p_cat_id')
        ->orderBy('tipo_categorias.p_cat_order', 'asc') // 1 para Damas, 2 para Caballeros
        ->orderBy('categorias.id', 'desc')              // Segundo criterio por si hay varias en la misma categoría
        ->select('categorias.*')                         // Evita conflictos de columnas con el mismo nombre
        ->get();
        
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        $tipo_categorias = TipoCategoria::orderBy('p_cat_id', 'desc')->get();
        return view('admin.categorias.create', compact('tipo_categorias'));
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos del formulario
        $request->validate([
            'sle_tipo'          => 'required',
            'nombre'            => 'required|string|max:255',
            'slug'              => 'required|string|unique:categorias,slug',
            'nombre_seo'        => 'required|string|max:255',
            'primary_image'     => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title'        => 'nullable|string|max:250',
            'meta_description'  => 'nullable|string',
            'status'            => 'required|in:0,1',
        ]);

        // 2. Manejo de la Imagen
        $imageName = null;
        if ($request->hasFile('primary_image')) {
            $image = $request->file('primary_image');
            // Generamos un nombre único con el slug y timestamp
            $imageName = $request->slug . '-' . time() . '.' . $image->getClientOriginalExtension();

            // Definimos la ruta (asegúrate de que la carpeta exista en public)
            $destinationPath = public_path('front/assets/images/categorias');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $image->move($destinationPath, $imageName);
        }

        // 3. Guardar en la Base de Datos usando el Modelo
        Categoria::create([
            'tipo_id'          => $request->sle_tipo, // Vinculado a p_cat_id
            'nombre'           => $request->nombre,
            'slug'             => $request->slug,
            'nombre_seo'       => $request->nombre_seo,
            'imagen'           => $imageName,
            'descripcion'      => $request->descripcion,
            'adicional'        => $request->adicional,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status'           => $request->status,      // 1 o 0
            'destacado'        => $request->destacado,   // 1 o 0
            'promocion'        => $request->promocion,   // 1 o 0
            'count_prod'       => 0,                     // Valor por defecto
        ]);
        return redirect()->route('admin.categorias.index')->with('success', '¡Categoría creada con éxito!');
    }

    public function edit($id)
    {
        // Buscamos el banner por ID o fallamos si no existe

        $tipo_categorias = TipoCategoria::orderBy('p_cat_id', 'desc')->get();
        $categoria = Categoria::findOrFail($id);

        // Retornamos la vista con los datos del banner
        return view('admin.categorias.edit', compact('categoria', 'tipo_categorias'));
    }

    public function update(Request $request, $id)
    {
        // 1. Buscamos la categoría por ID (o usamos Type Hinting si prefieres)
        $categoria = Categoria::findOrFail($id);

        // 2. Validamos los datos
        $request->validate([
            'sle_tipo'          => 'required',
            'nombre'            => 'required|string|max:255',
            'slug'              => 'required|string|unique:categorias,slug,' . $id,
            'nombre_seo'        => 'required|string|max:255',
            'primary_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title'        => 'nullable|string|max:250',
            'status'            => 'required|in:0,1',
        ]);

        // 3. Gestión de la Imagen
        $imageName = $categoria->imagen; // Mantenemos la imagen actual por defecto

        if ($request->hasFile('primary_image')) {
            $image = $request->file('primary_image');

            // Eliminamos la imagen anterior si existe físicamente
            $oldImagePath = public_path('front/assets/images/categorias/' . $categoria->imagen);
            if (File::exists($oldImagePath) && !empty($categoria->imagen)) {
                File::delete($oldImagePath);
            }

            // Guardamos la nueva imagen con nombre único
            $imageName = $request->slug . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/categorias'), $imageName);
        }

        // 4. Actualizamos los datos en la BD
        $categoria->update([
            'tipo_id'          => $request->sle_tipo,
            'nombre'           => $request->nombre,
            'slug'             => $request->slug,
            'nombre_seo'       => $request->nombre_seo,
            'imagen'           => $imageName,
            'descripcion'      => $request->descripcion,
            'adicional'        => $request->adicional,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status'           => $request->status,
            'destacado'        => $request->destacado,
            'promocion'        => $request->promocion,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $categoria = Categoria::findOrFail($id);

        // 2. Definimos la ruta de la imagen
        $imagePath = public_path('front/assets/images/categorias/' . $categoria->imagen);

        // 3. Verificamos si el archivo existe y lo eliminamos del servidor
        if (file_exists($imagePath) && !empty($categoria->imagen)) {
            @unlink($imagePath); // Elimina el archivo físico
        }

        // 4. Eliminamos el registro de la base de datos
        $categoria->delete();

        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria e imagen eliminados con éxito.');
    }
}
