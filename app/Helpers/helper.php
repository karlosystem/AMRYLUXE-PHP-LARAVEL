<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use App\Models\Compare;
use App\Models\Wishlist;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

function get_configuracion(){
        return DB::table('configuracion')->first();
}

function get_lista_categorias(){
        return DB::table('categorias as c')
        ->leftJoin('tipo_categorias as t', 'c.tipo_id', '=', 't.p_cat_id')
        ->select(
            'c.id',
            DB::raw("CONCAT(t.p_cat_name, ' | ', c.nombre) AS nombre"),
            'c.slug',
            'c.orden',
            'c.status',
            'c.destacado'
        )
        ->where('c.status', 1)
        ->where('c.destacado', 1)
        ->orderBy('t.p_cat_id')
        ->get();
}

function compareCount(){
        if(Auth::check()){
                return Compare::where('user_id', Auth::id())->count();
        }
        return 0;
}

function wishListCount(){
        if(Auth::check()){
                return Wishlist::where('user_id', Auth::id())->count();
        }
        return 0;
}

if (!function_exists('orderStatusCount')) {
    function orderStatusCount($status)
    {
        return Order::where('user_id', Auth::id())->where('order_status', $status)->count();
    }
}