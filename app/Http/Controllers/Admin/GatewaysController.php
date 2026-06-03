<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Gateway;
use Illuminate\Support\Facades\File;

class GatewaysController extends Controller
{
    public function edit()
    {
        $gateways = Gateway::all()->keyBy('name');
        return view('admin.gateways.edit', compact('gateways'));
    }

    public function update(Request $request)
    {
        // 1. Definición de reglas de validación condicionales
        $request->validate([
            // Validación para Stripe
            'stripe_status'     => 'required|boolean',
            'stripe_public_key' => 'required_if:stripe_status,1|nullable|string',
            'stripe_secret_key' => 'required_if:stripe_status,1|nullable|string',

            // Validación para PayPal
            'paypal_status'        => 'required|boolean',
            'paypal_client_id'     => 'required_if:paypal_status,1|nullable|string',
            'paypal_client_secret' => 'required_if:paypal_status,1|nullable|string',

            // Validación para Razorpay
            'razorpay_status'     => 'required|boolean',
            'razorpay_key_id'     => 'required_if:razorpay_status,1|nullable|string',
            'razorpay_key_secret' => 'required_if:razorpay_status,1|nullable|string',

            // Validación para SSLCommerz
            'sslcommerz_status'         => 'required|boolean',
            'sslcommerz_store_id'       => 'required_if:sslcommerz_status,1|nullable|string',
            'sslcommerz_store_password' => 'required_if:sslcommerz_status,1|nullable|string',

            // Validación para COD (solo estado)
            'cod_status' => 'required|boolean',
        ], [
            // Mensajes personalizados (opcional)
            'required_if' => 'El campo :attribute es obligatorio cuando la pasarela está activa.',
        ]);

        // 2. Actualización de registros (Lógica persistente)

        // Stripe
        Gateway::where('name', 'Stripe')->update([
            'credentials' => [
                'public_key' => $request->stripe_public_key,
                'secret_key' => $request->stripe_secret_key,
            ],
            'status' => $request->stripe_status,
        ]);

        // PayPal
        Gateway::where('name', 'PayPal')->update([
            'credentials' => [
                'client_id'     => $request->paypal_client_id,
                'client_secret' => $request->paypal_client_secret,
            ],
            'status' => $request->paypal_status,
        ]);

        // Razorpay
        Gateway::where('name', 'Razorpay')->update([
            'credentials' => [
                'key_id'     => $request->razorpay_key_id,
                'key_secret' => $request->razorpay_key_secret,
            ],
            'status' => $request->razorpay_status,
        ]);

        // SSLCommerz
        Gateway::where('name', 'SSLCommerz')->update([
            'credentials' => [
                'store_id'       => $request->sslcommerz_store_id,
                'store_password' => $request->sslcommerz_store_password,
            ],
            'status' => $request->sslcommerz_status,
        ]);

        // COD
        Gateway::where('name', 'COD')->update([
            'status' => $request->cod_status,
        ]);

        return redirect()->back()->with('success', 'Configuraciones de pago actualizadas y validadas correctamente.');
    }
}
