<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoGaleria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator; // Importante arriba

use Illuminate\Support\Facades\Storage;

// No olvides importar los modelos al inicio del archivo
use App\Models\TipoCategoria;
use App\Models\Marca;
use App\Models\Categoria;

class ProductoController extends Controller
{

    public function index()
    {
        // 1. Obtener los productos ordenados (el código que ya teníamos)
        $productos = Producto::select('productos.*')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->join('tipo_categorias', 'categorias.tipo_id', '=', 'tipo_categorias.p_cat_id')
            ->with(['categoria.tipo', 'marca'])
            ->orderBy('tipo_categorias.p_cat_order', 'asc')
            ->orderBy('productos.id', 'desc')
            ->get();

        // 2. Calcular los conteos para los botones de filtro
        // Esto agrupa por el ID del tipo de categoría y cuenta cuántos productos hay en cada uno
        $counts = [
            'total'      => $productos->count(),
            'mujer'      => $productos->where('categoria.tipo.p_cat_name', 'Mujer')->count(),
            'hombre'     => $productos->where('categoria.tipo.p_cat_name', 'Hombre')->count(),
            'ninos'      => $productos->where('categoria.tipo.p_cat_name', 'Ninos')->count(),
            'accesorios' => $productos->where('categoria.tipo.p_cat_name', 'Accesorios')->count(),
        ];
        return view('admin.productos.index', compact('productos', 'counts'));
    }

    public function create()
    {
        // Obtenemos los tipos de categoría ordenados por tu columna p_cat_order
        $tipos = TipoCategoria::where('p_cat_status', 1)
            ->orderBy('p_cat_order', 'asc')
            ->get();

        // Obtenemos las marcas disponibles
        $marcas = Marca::orderBy('nombre', 'asc')->get();

        // Generar SKU Único: US-XXXXX
        do {
            // Str::random(6) genera caracteres alfanuméricos aleatorios
            $randomPart = strtoupper(Str::random(6));
            $sku = 'US-' . $randomPart;

            // Verificamos si ya existe en la base de datos
            $exists = Producto::where('codigo', $sku)->exists();
        } while ($exists);


        // Retornamos la vista con los datos compactados
        return view('admin.productos.create', compact('tipos', 'marcas', 'sku'));
    }

    public function getCategorias($tipo_id)
    {
        // Buscamos categorías cuyo tipo_id coincida con el p_cat_id seleccionado
        $categorias = Categoria::where('tipo_id', $tipo_id)
            ->where('status', '1')
            ->orderBy('nombre', 'asc')
            ->get();

        return response()->json($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Solo esto. Si falla, Laravel se encarga de todo el redirect y los errores.
        $request->validate([
            'nombre'            => 'required|string|max:255',
            'categoria_id'      => 'required|integer|exists:categorias,id',
            'slug'              => 'required|string|unique:productos,slug',
            'codigo'            => 'required|string|unique:productos,codigo',
            'precio'            => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'delivery_duration' => 'required|in:24 horas,48 horas,72 horas',
            'imagen'            => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nombre.required'       => 'El nombre es obligatorio.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'precio.required'       => 'El precio es necesario.',
            'slug.unique'           => 'Esta URL ya está en uso.',
        ]);

        // Si llega aquí, es porque TODO ESTÁ BIEN.
        // Aquí pones tu código para guardar...
    }


    public function guardarGaleria(Request $request, $id)
    {
        // 1. Validación
        $request->validate([
            'imagenes.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $producto = Producto::findOrFail($id);

        // Definimos la ruta de destino dentro de public
        $destinationPath = public_path('front/assets/images/productos/galeria');

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $file) {

                // 2. Generar nombre único: ej. 176_gal_82345.jpg
                $extension = $file->getClientOriginalExtension();
                $filename = $producto->id . '_gal_' . uniqid() . '.' . $extension;

                // 3. Mover el archivo a la carpeta pública
                $file->move($destinationPath, $filename);

                // 4. Guardar en la base de datos (solo guardamos el nombre del archivo)
                ProductoGaleria::create([
                    'producto_id' => $producto->id,
                    'imagen'      => $filename,
                    'orden'       => $index + 1
                ]);
            }
        }

        return back()->with('success', '¡Galería actualizada correctamente!');
    }

    public function eliminarImagenGaleria($id)
    {
        $imagenGaleria = ProductoGaleria::findOrFail($id);
        $filePath = public_path('front/assets/images/productos/galeria/' . $imagenGaleria->imagen);

        // Borrar el archivo físico si existe
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Borrar registro de la base de datos
        $imagenGaleria->delete();

        return back()->with('success', 'Imagen eliminada de la galería.');
    }

    /**
     * Update the specified resource in storage.
     */

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        // Cargamos todas las categorías activas directamente
        $categorias = Categoria::where('status', 1)->orderBy('nombre', 'ASC')->get();
        $marcas = Marca::orderBy('nombre', 'ASC')->get();

        return view('admin.productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        // 1. Validación (Opcional, pero recomendada)
        $request->validate([
            'nombre' => 'required|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Capturar datos de texto y checkboxes
        $data = $request->all();

        // Manejo manual de checkboxes (si no se marcan, el request no los envía)
        $data['recienllegado'] = $request->has('recienllegado') ? 1 : 0;
        $data['mejorvendido']  = $request->has('mejorvendido') ? 1 : 0;
        $data['destacado']     = $request->has('destacado') ? 1 : 0;
        $data['liquidacion']   = $request->has('liquidacion') ? 1 : 0;
        $data['enventa']       = $request->has('enventa') ? 1 : 0;
        $data['status']        = $request->has('status') ? 1 : 0;

        // 3. Gestión de la Imagen
        if ($request->hasFile('imagen')) {
            $rutaCarpeta = public_path('front/assets/images/productos');

            // Borrar imagen anterior si existe
            if ($producto->imagen) {
                $rutaAnterior = $rutaCarpeta . '/' . $producto->imagen;
                if (File::exists($rutaAnterior)) {
                    File::delete($rutaAnterior);
                }
            }

            // Subir la nueva imagen
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move($rutaCarpeta, $nombreImagen);

            // Guardamos el nuevo nombre en el array de datos
            $data['imagen'] = $nombreImagen;
        } else {
            // Si no se subió imagen, mantenemos la que ya tiene
            unset($data['imagen']);
        }

        // 4. Actualizar en la base de datos
        $producto->update($data);

        return redirect()->route('admin.productos.index')
            ->with('success', '¡Producto actualizado correctamente!');
    }
}
