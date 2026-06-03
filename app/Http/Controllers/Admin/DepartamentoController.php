<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la fachada


class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::orderBy('id', 'desc')->get();
        return view('admin.departamentos.index', compact('departamentos'));
    }

    public function edit(Departamento $departamento)
    {
        // Usamos Route Model Binding ($departamento coincide con el nombre en la ruta)
        return view('admin.departamentos.edit', compact('departamento'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'status'   => 'required|integer',
            'tax_rate' => 'required|numeric|min:0',
        ]);

        $departamento->update($request->all());

        return redirect()->route('admin.departamentos.index')
            ->with('success', 'Departamento actualizado correctamente.');
    }
}
