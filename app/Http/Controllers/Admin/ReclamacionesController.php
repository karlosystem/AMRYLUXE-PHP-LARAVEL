<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Reclamaciones;
use Illuminate\Support\Facades\File;

class ReclamacionesController extends Controller
{
    public function index()
    {
        $reclamaciones = Reclamaciones::orderBy('id', 'desc')->get();
        return view('admin.reclamaciones.index', compact('reclamaciones'));
    }

    public function changeStatus($id)
    {
        try {
            $reclamacion = Reclamaciones::findOrFail($id);
            // Alternar estado: si es 0 pasa a 1, si es 1 pasa a 0
            $reclamacion->estado = $reclamacion->estado == 0 ? 1 : 0;
            $reclamacion->save();

            return response()->json([
                'success' => true,
                'nuevo_estado' => $reclamacion->estado,
                'message' => 'Estado actualizado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar.'], 500);
        }
    }

    // En admin/ReclamacionesController.php

    public function getDetalle($id)
    {
        $reclamacion = Reclamaciones::findOrFail($id);
        return response()->json($reclamacion);
    }


}