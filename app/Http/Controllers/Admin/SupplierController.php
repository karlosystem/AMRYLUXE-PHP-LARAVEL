<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Exception;

class SupplierController extends Controller
{
    /**
     * Mostrar listado de proveedores.
     */
    public function index()
    {
        // Obtenemos los proveedores con el conteo de sus compras realizadas
        $suppliers = Supplier::withCount('purchases')->orderBy('id', 'desc')->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Guardar un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255|unique:suppliers,email',
            'phone'   => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        try {
            Supplier::create($request->all());
            return redirect()->route('admin.suppliers.index')->with('success', 'Proveedor creado exitosamente.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error al crear: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Actualizar los datos del proveedor.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255|unique:suppliers,email,' . $id,
            'phone'   => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        try {
            $supplier->update($request->all());
            return redirect()->route('admin.suppliers.index')->with('success', 'Proveedor actualizado correctamente.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        try {
            // Verificamos si tiene compras asociadas antes de eliminar
            if ($supplier->purchases()->count() > 0) {
                return back()->with('error', 'No se puede eliminar el proveedor porque tiene compras registradas.');
            }

            $supplier->delete();
            return redirect()->route('admin.suppliers.index')->with('success', 'Proveedor eliminado con éxito.');
        } catch (Exception $e) {
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}