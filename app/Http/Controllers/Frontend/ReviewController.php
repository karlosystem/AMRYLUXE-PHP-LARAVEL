<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Color;
use App\Models\Tamano;
use App\Models\Pagina;
use App\Models\Review;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'order_id'   => 'required',
            //'order_id'   => 'required|exists:orders,id',
            'rating'     => 'required|integer|min:1|max:5',
            'review'     => 'required|string|min:10',
        ]);

        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return back()->with('error', 'You do not have permission!');
        }

        // Verificar si el usuario ya ha enviado una reseña para este producto
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        // Insertar la nueva reseña
        Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
            'order_id'   => $request->order_id,
            'rating'     => $request->rating,
            'review'     => $request->review,
        ]);

        return back()->with('success', 'Your review has been submitted!');
    }
}
