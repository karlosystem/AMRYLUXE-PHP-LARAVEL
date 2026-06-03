<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoGaleria;
use Illuminate\Http\Request;

class ProductoGaleriaController extends Controller
{
    // Ruta definida según tu estructura de carpetas
    private $path = 'front/assets/images/productos/galeria';

    public function index($producto_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $galeria = ProductoGaleria::where('producto_id', $producto_id)->orderBy('orden')->get();
        return view('admin.productos.galeria', compact('producto', 'galeria'));
    }

    public function store(Request $request, $producto_id)
    {
        $request->validate(['imagenes.*' => 'required|image|mimes:jpeg,png,jpg|max:2048']);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                // Mantener nombres limpios como IMG_6240.png vistos en tu captura
                $nombreImagen = $file->getClientOriginalName();
                
                // Si el archivo ya existe, le ponemos un prefijo de tiempo para no sobrescribir
                if (file_exists(public_path($this->path . '/' . $nombreImagen))) {
                    $nombreImagen = time() . '_' . $nombreImagen;
                }

                $file->move(public_path($this->path), $nombreImagen);

                ProductoGaleria::create([
                    'producto_id' => $producto_id,
                    'imagen' => $nombreImagen,
                    'orden' => ProductoGaleria::where('producto_id', $producto_id)->max('orden') + 1
                ]);
            }
        }
        return back()->with('success', 'Imágenes añadidas a la galería.');
    }

    public function destroy($id)
    {
        $item = ProductoGaleria::findOrFail($id);
        $rutaCompleta = public_path($this->path . '/' . $item->imagen);

        if (file_exists($rutaCompleta)) {
            unlink($rutaCompleta);
        }

        $item->delete();
        return back()->with('success', 'Imagen eliminada de la galería.');
    }

    // En ProductoGaleriaController.php

        public function reordenar(Request $request)
        {
            $orden = $request->orden; // Array de objetos {id, posicion}

            foreach ($orden as $item) {
                ProductoGaleria::where('id', $item['id'])->update([
                    'orden' => $item['posicion']
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Orden actualizado']);
        }


}