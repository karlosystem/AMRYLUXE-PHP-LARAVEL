<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelCart;
use App\Models\Producto;
use Illuminate\Http\Request;

class CartController extends Controller
{
      public function index()
    {
        return view('front/cart.index');
    }

    public function create()
    {
        return view('cart.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('cart.index');
    }
    
    public function addToCart(Request $request)
    {
        $producto_id = $request->input('productoId');
        $cantidad = $request->input('cantidad', 1);
        $producto = Producto::find($producto_id);

        if (!$producto) {
            return response()->json(['status' => 'error', 'message' => 'Producto No Encontrado']);
        }

        //crear la session
        $cart = session()->get('cart', []);
        if (isset($cart[$producto_id])) {
            //$cart['producto_id']['cantidad'] += $cantidad;
            $cart[$producto_id]['cantidad'] += $cantidad;
        } else {
            $cart[$producto_id] = [
                "nombre" => $producto->nombre,
                "id" => $producto->id,
                "precio" => $producto->precio,
                "precio_regular" => $producto->precio_regular,
                "imagen" => $producto->imagen,
                "cantidad" => $cantidad,
                "color" => $color ?? "algun color",
                "tamano" => $tamano ?? "algun tamano",
            ];
        }
        session()->put('cart', $cart);
        //actualizar count de cart
        $cartCount = count($cart);
        //calcular el precio total
        $totalPrecio = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);
        
        return response()->json([
            'status' => 'success',
            'cart_count' => $cartCount,
            'total_price' => number_format($totalPrecio, 2)
        ]);
    }

    public function cartCount(){
        $cart = session()->get('cart', []);
        $cartCount = count($cart);
        return response()->json(['cart_count'], $cartCount);
    }

    public function removeFromCart(Request $request)
    {
        //recuperar la sesion del carrito de compras
        $cart = session()->get('cart', []);
        $producto_id = $request->input('producto_id');
        
        //eliminar el producto del carrito de compras
        if (isset($cart[$producto_id])) {
            unset($cart[$producto_id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Producto ha sido eliminado del carrito de compras');
    }

    public function cartIncrease(Request $request){
        $cart = session()->get('cart', []);
        $producto_id = $request->input('producto_id');

        if (isset($cart[$producto_id])) {
            $cart[$producto_id]['cantidad']++;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function cartDecrease(Request $request)
    {
        $cart = session()->get('cart', []);
        $producto_id = $request->input('producto_id');

        if (isset($cart[$producto_id])) {
            if ($cart[$producto_id]['cantidad'] > 1) {
                $cart[$producto_id]['cantidad']--;
            } else {
                unset($cart[$producto_id]);
            }
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function updateCart(Request $request)
        {
            $cart = session()->get('cart', []);
            $updatedData = $request->input('cart_update'); // Recibe el array de IDs y cantidades

            if ($updatedData) {
                foreach ($updatedData as $id => $data) {
                    if (isset($cart[$id])) {
                        // Actualizamos la cantidad con lo que viene del formulario
                        $cart[$id]['cantidad'] = max(1, intval($data['qty']));
                    }
                }
                session()->put('cart', $cart);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Carrito actualizado correctamente'
                ]);
            }

            return response()->json(['status' => 'error', 'message' => 'No hay datos para actualizar'], 400);
        }


}
