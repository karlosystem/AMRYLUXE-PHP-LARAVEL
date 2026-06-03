<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = User::orderBy('id', 'desc')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    public function destroy($id)
    {
        try {
            $cliente = User::findOrFail($id);

            // 1. Definir la ruta de la imagen
            $imagePath = public_path('front/assets/images/usuarios/' . $cliente->image);

            // 2. Verificar si existe la imagen física y eliminarla
            if ($cliente->image && File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // 3. Eliminar el registro de la base de datos
            $cliente->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Cliente eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al eliminar: ' . $e->getMessage()
            ]);
        }
    }
}
