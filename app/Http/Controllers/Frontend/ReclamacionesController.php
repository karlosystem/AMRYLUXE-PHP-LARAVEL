<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Reclamaciones;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReclamacionesController extends Controller
{
    public function reclamaciones()
    {
        return view('front.reclamaciones.index');
    }

    public function store(Request $request)
    {
        // 1. Validar los datos
        $request->validate([
            'nombres' => 'required|string|max:120',
            'apellidos' => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'tipo_documento' => 'required',
            'nro_documento' => 'required|string|max:30',
            'telefono' => 'required|string|max:30',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'tipo_reclamo' => 'required',
            'bien_contratado' => 'required',
            'monto' => 'required',
            'descripcion_producto' => 'required',
            'fecha_problema' => 'required',
        ]);

        try {
            // 2. Crear el registro en la base de datos
            // Usamos $request->all() porque los nombres del form coinciden con el $fillable del modelo
            $reclamacion = Reclamaciones::create($request->all());

            // 3. Redireccionar con mensaje de éxito
            return redirect()->back()->with('success', 'Su reclamación ha sido registrada con éxito. Nro de registro: ' . $reclamacion->id);
        } catch (\Exception $e) {
            // Log del error para el desarrollador
            Log::error("Error al grabar reclamación: " . $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un problema al enviar sus datos. Por favor, intente nuevamente.');
        }
    }
}
