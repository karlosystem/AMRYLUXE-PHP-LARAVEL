<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Distrito;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la fachada


class DistritoController extends Controller
{
    public function index()
    {
        // Cargamos relaciones para evitar el problema N+1
        $distritos = Distrito::with(['departamento', 'provincia'])
            ->orderBy('id', 'desc')
            ->paginate(50); // Usamos paginación porque son más de 1,800 distritos en Perú

        return view('admin.distritos.index', compact('distritos'));
    }

    public function edit(Distrito $distrito)
    {
        return view('admin.distritos.edit', compact('distrito'));
    }

    public function update(Request $request, Distrito $distrito)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1',
            'name' => 'required|string|max:120'
        ]);

        $distrito->update($request->all());

        return redirect()->route('admin.distritos.index')
            ->with('success', 'Distrito ' . $distrito->name . ' actualizado.');
    }
}
