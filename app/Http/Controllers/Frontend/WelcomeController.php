<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $banners = DB::table('banners')->where('status', 1)->get();
        $testimonios = DB::table('testimonios')->where('status', 1)->get();
        $productos_nuevos = Producto::where('status', 1)->latest()->take(4)->get();


        /*         $categorias = Categoria::select('p_cat_name', 'nombre', 'status', 'slug')
        ->join('tipo_categorias', 'categorias.tipo_id', '=', 'tipo_categorias.p_cat_id')
        ->limit(6)->orderBy('nombre', 'ASC')->get();  */

        $categorias = Categoria::with('tipo')
            ->where('status', 1)
            ->orderBy('nombre', 'ASC')
            ->limit(6)
            ->get();


        $data['destacados']     =    Producto::where('status', 1)->where('destacado', 1)->latest()->take(4)->get();
        $data['enventa']        =    Producto::where('status', 1)->where('enventa', 1)->latest()->take(4)->get();
        $data['mejorvendido']   =    Producto::where('status', 1)->where('mejorvendido', 1)->latest()->take(4)->get();
        $data['recienllegado']  =    Producto::where('status', 1)->where('recienllegado', 1)->latest()->take(4)->get();

        // consultas nuevas para el nuevo diseño de amryluxe
        //$data['carteras_cuero_nacional']  =  Producto::where('status', 1)->where('categoria_id',120)->oldest()->take(10)->get();

        $data['carteras_cuero_nacional'] = Producto::where('status', 1)
            ->where('categoria_id', 120)
            ->orderByDesc('id') // Ordena por ID del más alto al más bajo
            ->take(10)
            ->get();

        $data['bolsos_cuero'] = Producto::where('status', 1)
            ->where('categoria_id', 18)
            ->orderByDesc('id') // Ordena por ID del más alto al más bajo
            ->take(10)
            ->get();

        $data['carteras_importadas'] = Producto::where('status', 1)
            ->where('categoria_id', 19)
            ->orderByDesc('id') // Ordena por ID del más alto al más bajo
            ->take(10)
            ->get();

        $data['billeteras_mujer'] = Producto::where('status', 1)
            ->where('categoria_id', 98)
            ->orderByDesc('id') // Ordena por ID del más alto al más bajo
            ->take(10)
            ->get();

       // 2. Categorías Damas con su relación 'tipo'
        $categorias_damas = Categoria::with('tipo')
        ->where('tipo_id', 20)
        ->where('status', 1)
        ->orderBy('nombre', 'ASC')
        ->limit(30)
        ->get();

        $categorias_otras = Categoria::with('tipo')
            ->where('tipo_id', '<>', 20)
            ->where('status', 1)
            ->orderBy('nombre', 'ASC')
            ->get();

        return view('welcome', compact('banners', 'testimonios', 'categorias', 'productos_nuevos', 'categorias_damas', 'categorias_otras', 'data'));
    }
}
