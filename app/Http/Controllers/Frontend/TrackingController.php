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


class TrackingController extends Controller
{
    public function orderTracking($number){
        $order = Order::with('orderItems')->where('tracking_number', $number)->first();
        if (!$order) {
            return redirect()->back()->with('Error', 'Orden no encontrada !! Por favor Ingrese el numero de Tracking valido');
        }         
        return view('front.track.index', compact('order'));

    }

}