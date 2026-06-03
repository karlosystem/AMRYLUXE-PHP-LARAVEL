<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\ModelCart;
use App\Models\Producto;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Mime\Message;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Es necesario logearse');
        }

        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|string|max:255',
            'shipping_street_address' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:50',
            'shipping_departament' => 'required|string|max:100',
            'shipping_provincia' => 'required|string|max:100',
            'shipping_distrito' => 'required|string|max:100',
            'shipping_zipcode' => 'required|string|max:20',

            'payment' => 'required|in:interbank,bcp,yape,efectivo,paypal,creditcard',

            'billing_name' => $request->has('copy_address') ? 'required|string|max:255' : 'nullable',
            'billing_email' => $request->has('copy_address') ? 'required|string|max:255' : 'nullable',
            'billing_street_address' => $request->has('copy_address') ? 'required|string|max:255' : 'nullable',
            'billing_phone' => $request->has('copy_address') ? 'required|string|max:50' : 'nullable',
            'billing_departament' => $request->has('copy_address') ? 'required|string|max:100' : 'nullable',
            'billing_provincia' => $request->has('copy_address') ? 'required|string|max:100' : 'nullable',
            'billing_distrito' => $request->has('copy_address') ? 'required|string|max:100' : 'nullable',
            'billing_zipcode' => $request->has('copy_address') ? 'required|string|max:20' : 'nullable',

        ]);

        try {
            $orderNumber = 'ORD-' . strtoupper(Str::random(10));
            $couponCode = session('coupon.code', '');
            $descuento = session('coupon.descuento', 0);
            $tax = session('tax.tax_rate', 0);
            $shipping = session('shipping.shipping.charge', 0);
            $subtotal = collect(session('cart', []))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']);
            $subtotal = (float) $subtotal;
            $grandTotal = ($subtotal + $tax + $shipping) - $descuento;

            // metodo de pago
            $paymentMethod = $request->payment;

            if ($paymentMethod === 'interbank' && $paymentMethod === 'bcp') {
                $status = 'pending';
            } else {
                $status = 'paid';
            }


            //Guardar la orden
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,

                //Billing Details
                'billing_name' => $request->billing_name,
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'billing_street_address' => $request->billing_street_address,
                'billing_district' => $request->billing_distrito,
                'billing_province' => $request->billing_provincia,
                'billing_zipcode' => $request->billing_zipcode,
                'billing_departament' => $request->billing_departament,

                //Shipping Details
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_street_address' => $request->shipping_street_address,
                'shipping_district' => $request->shipping_distrito,
                'shipping_province' => $request->shipping_provincia,
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_departament' => $request->shipping_departament,
    
                //Nuevos Registros
                'coupon_code' => $couponCode,
                'discounted_amount' => $descuento,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'subtotal_amount' => $subtotal,

                'tracking_number' => 'TRK-' . strtoupper(Str::random(12)),
                'notes' => $request->notes ?? '',

                //orden de pago
                'total_amount' => $grandTotal,
                'payment_method' => $request->payment,
                'payment_status' => $status,
                'order_status' => 'pending',
            ]);

            // GRABAR OrderItem
            if ($order) {
                foreach (session('cart', []) as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'product_name' => $item['nombre'],
                        'thumb' => $item['imagen'],
                        'color' => $item['color'] ?? null,
                        'size' => $item['tamano'] ?? null,
                        'quantity' => $item['cantidad'],
                        'price' => $item['precio'] ?? $item['precio_regular'],
                        'total' => ($item['precio'] ?? $item['precio_regular'])*$item['cantidad'],
                    ]);
                }
            }

        } catch (\Throwable $e) {
            Log::error('La orden de compra ha fallado' . $e->getMessage(), [
                'exception' => $e
            ]);
        } finally {
            //destruir las sessiones // no hay shipping
            session()->forget(['cart', 'coupon', 'tax', 'shipping']);
        }

        return redirect()->route('checkout.success', ['order' => $order->id])->with('success', 'Orden de compra generada con éxito');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('front.checkout.success', compact('order'));
    }

    public function invoice($id){
         $order = Order::with('orderItems')->where('id', $id)->first();
        if (!$order) {
            abort(404);
        }         
        return view('front.invoice.index', compact('order'));
    }


}
