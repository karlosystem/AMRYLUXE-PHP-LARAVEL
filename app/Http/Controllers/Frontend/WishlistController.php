<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Es necesario logearse');
        }
        $user = Auth::user();
        $wishListProducts = Wishlist::where('user_id', $user->id)->with('product')->get();
        return view('front/wishlist.index', compact('wishListProducts'));
    }

    public function addToWishList(Request $request)
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

        $exists = Wishlist::where('user_id', $user->id)
            ->where('producto_id', $product_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Este producto ya está en tu lista de deseos'
            ]);
        }

        Wishlist::create([
            'user_id' => $user->id,
            'producto_id' => $product_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado a la lista de deseos'
        ]);
    }


    public function remove($id)
    {
        $user = Auth::user();
        $compare = Wishlist::where('user_id', $user->id)->where('producto_id', $id)->first();
        if (!$compare) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
        $compare->delete();
        return response()->json(['success' => true, 'Eliminado de la lista de deseos']);
    }
}
