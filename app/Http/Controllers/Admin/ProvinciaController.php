<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index()
    {
        // Traemos las provincias con su departamento relacionado
        $provincias = Provincia::with('departamento')->orderBy('name', 'asc')->get();
        return view('admin.provincias.index', compact('provincias'));
    }

    public function edit(Provincia $provincia)
    {
        return view('admin.provincias.edit', compact('provincia'));
    }

    public function update(Request $request, Provincia $provincia)
    {
        $request->validate([
            'shipping_charge' => 'required|numeric|min:0',
            'status' => 'required|integer'
        ]);

        $provincia->update($request->only('shipping_charge', 'status'));

        return redirect()->route('admin.provincias.index')
                         ->with('success', 'Costo de envío actualizado para ' . $provincia->name);
    }

}