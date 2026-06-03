<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\File;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'code'                 => 'required|string|unique:coupons,code|max:255',
            'type'                 => 'required|in:fixed,percentage',
            'discount_value'       => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'expiry_date'          => 'nullable|date|after_or_equal:today',
            'status'               => 'required|boolean',
        ], [
            'code.unique' => 'Este código de cupón ya existe, por favor elige otro.',
            'expiry_date.after_or_equal' => 'La fecha de expiración no puede ser anterior a hoy.'
        ]);

        // 2. Creación del registro
        Coupon::create([
            'code'                 => strtoupper($request->code), // Guardar siempre en mayúsculas
            'type'                 => $request->type,
            'discount_value'       => $request->discount_value,
            'minimum_order_amount' => $request->minimum_order_amount ?? 0,
            'expiry_date'          => $request->expiry_date,
            'status'               => $request->status,
        ]);

        // 3. Redirección con mensaje de éxito
        return redirect()->route('admin.coupon.index')
            ->with('success', '¡Cupón creado exitosamente!');
    }

    public function edit($id)
    {
        $cupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('cupon'));
    }


    public function update(Request $request, $id)
    {
        $cupon = Coupon::findOrFail($id);

        $request->validate([
            'code'                 => 'required|string|max:255|unique:coupons,code,' . $id,
            'type'                 => 'required|in:fixed,percentage',
            'discount_value'       => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'expiry_date'          => 'nullable|date',
            'status'               => 'required|boolean',
        ]);

        $cupon->update([
            'code'                 => strtoupper($request->code),
            'type'                 => $request->type,
            'discount_value'       => $request->discount_value,
            'minimum_order_amount' => $request->minimum_order_amount ?? 0,
            'expiry_date'          => $request->expiry_date,
            'status'               => $request->status,
        ]);

        return redirect()->route('admin.coupon.index')->with('success', 'Cupón actualizado correctamente.');
    }


    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $cupon = Coupon::findOrFail($id);
        // 4. Eliminamos el registro de la base de datos
        $cupon->delete();
        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.coupon.index')->with('success', 'Codigo de Coupon eliminados con éxito.');
    }
}
