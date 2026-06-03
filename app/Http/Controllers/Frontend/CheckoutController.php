<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelCheckout;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        } 
        $departamentos = DB::table('departments')->get();
        $gateways = Gateway::all()->keyBy('name');
        return view('front/checkout.index', compact('departamentos', 'gateways'));
    }

    public function getStates($departament_id){
        $provincias = DB::table('provinces')->where('department_id', $departament_id)->get();
        return response()->json(['states' => $provincias]);    
    }

    public function getDistricts($province_id)
    {
        $districts = DB::table('districts')
            ->where('province_id', $province_id)
            ->orderBy('name')
            ->get();

        return response()->json($districts);
    }

    public function getDepartmentTax($department_id)
    {
        $department = DB::table('departments')
            ->where('id', $department_id)
            ->select('tax_rate')
            ->first();
        $subtotal = collect(session('cart', []))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']);
        $taxAmount = ($department->tax_rate/100)*$subtotal;
        // crear una session
        session()->put('tax', [
                'tax_rate' => $taxAmount ?? 0,
        ]);

        return response()->json(['costo_envio' => $department->tax_rate ?? 0]);
    }

   
}
