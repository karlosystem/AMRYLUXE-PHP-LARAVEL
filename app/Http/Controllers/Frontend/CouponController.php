<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelCheckout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required'
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', 1)
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón inválido'
            ]);
        }

        if ($coupon->expiry_date && Carbon::now()->gt($coupon->expiry_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Este cupón ha expirado'
            ]);
        }

        $subtotal = collect(session('cart'))->sum(
            fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']
        );

        if ($coupon->minimum_order_amount && $subtotal < $coupon->minimum_order_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Monto mínimo requerido: S/. ' . number_format($coupon->minimum_order_amount, 2)
            ]);
        }

        // CALCULAR DESCUENTO
        $discount = ($coupon->type === 'percentage')
            ? ($subtotal * $coupon->discount_value / 100)
            : $coupon->discount_value;

        session([
            'coupon' => [
                'code' => $coupon->code,
                'discount' => $discount
            ]
        ]);

        return response()->json([
            'success' => true,
            'discount' => number_format($discount, 2),
            'message' => 'Cupón aplicado correctamente'
        ]);
    }
}
