<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfiguracionController extends Controller
{
    // Solo mostramos el formulario de edición (normalmente el ID es 1)
    public function edit()
    {
        $config = Configuracion::first(); // Obtenemos el único registro de ajustes
        return view('admin.configuracion.edit', compact('config'));
    }

    public function update(Request $request, $id)
    {
        $config = Configuracion::findOrFail($id);

        // 1. Validación de campos de texto y archivos
        $request->validate([
            'nombre_web'       => 'required|string|max:180',
            'email'            => 'required|email|max:100',
            'logo'             => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'logofooter'       => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'favicon'          => 'nullable|image|mimes:png,ico,webp|max:512',
            'og_imagen'        => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $data = $request->all();

        // 2. Procesamiento Dinámico de Imágenes
        // Definimos los nombres de las columnas que son archivos
        $fileFields = ['logo', 'logofooter', 'favicon', 'og_imagen'];
        $destinationPath = public_path('front/assets/images/config');

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Generar nombre único: ej. logo-1706784000.png
                $fileName = $field . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Eliminar el archivo antiguo si existe físicamente
                $oldFilePath = $destinationPath . '/' . $config->$field;
                if (File::exists($oldFilePath) && !empty($config->$field)) {
                    File::delete($oldFilePath);
                }

                // Mover el nuevo archivo al servidor
                $file->move($destinationPath, $fileName);

                // Actualizar el nombre en el array de datos
                $data[$field] = $fileName;
            } else {
                // Si no se subió archivo nuevo, mantenemos el que ya estaba en la BD
                $data[$field] = $config->$field;
            }
        }

        // 3. Actualizar el registro en la BD
        $config->update($data);

        return redirect()->back()->with('success', 'La configuración global se ha actualizado correctamente.');
    }
}
