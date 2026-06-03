<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Es necesario logearse');
        }
        $user = Auth::user();
        $comparedProducts = Compare::where('user_id', $user->id)->with('product')->get();
        //dd($comparedProducts);
        return view('front/compare.index', compact('comparedProducts'));
    }

    public function addToCompare(Request $request)
    {
       if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe iniciar sesión para agregar a la lista de deseos'
            ], 401);
        }

         $request->validate([
            'product_id' => 'required|exists:productos,id'
        ]);

        $user = Auth::user();
        $product_id = $request->product_id;

        //verificar si el producto ya existe en la lista de productos a comparar
        if (Compare::where('user_id', $user->id)->where('producto_id', $product_id)->exists()) {           
             return response()->json([
                'success' => false,
                'message' => 'Este producto ya existe en la lista de comparacion'
            ]);
        }

        if (Compare::where('user_id', $user->id)->count() >= 2) {
             return response()->json([
                'success' => false,
                'message' => 'Usted solo puede comparar 2 productos'
            ]);
        }

        //agregar a la lista de comparaciones
        Compare::create([
            'user_id' => $user->id,
            'producto_id' => $product_id
        ]);

        return response()->json([
                'success' => true,
                'message' => 'Usted acaba de agregar este producto a la lista de comparaciones'
        ]);
    }



    public function remove($id)
    {
        $user = Auth::user();
        $compare = Compare::where('user_id', $user->id)->where('producto_id', $id)->first();
        if (!$compare) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
        $compare->delete();
        return response()->json(['success' => true, 'Eliminado de la lista de comparaciones']);
    }
}
