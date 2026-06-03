<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Tamano;
use App\Models\Review;
use App\Models\Pagina;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::with('tipo') // Carga la relación para la URL amigable
        ->where('status', 1)
        ->get()
        ->map(function ($c) {
            // Creamos el nombre concatenado dinámicamente manteniendo el objeto Eloquent
            $c->nombre_full = ($c->tipo ? $c->tipo->p_cat_name : 'Sin Tipo') . ' | ' . $c->nombre;
            return $c;
        })
        ->sortBy(function($c) {
            return $c->tipo?->p_cat_id; // Ordenamos por el ID del tipo
        });

        // Consulta para el Sidebar: Colección Mujer con relación para URL amigable
        $coleccion_mujer = Categoria::with('tipo') // <--- Agregamos esto para el SEO dinámico
            ->where('tipo_id', 20)
            ->where('status', 1)
            ->where('destacado', 1)
            ->withCount('productos') 
            ->orderBy('nombre', 'ASC')
            ->get();

        $marcas = Marca::where('status', 1)->get();
        $data = Pagina::where('slug', 'colecciones')->first();

        $colores = Color::all();
        $tamanos = Tamano::all();

        $query = Producto::where('status', 1)->orderBy('id', 'DESC');

        if ($request->has('keywords') && !empty($request->keywords)) {
            $query->where('nombre', 'LIKE', '%' . $request->keywords . '%');
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->where('categoria_id', $request->category);
        }

        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('precio', '>=', $request->min_price);
        }

        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('precio', '<=', $request->max_price);
        }

        if ($request->has('brands') && !empty($request->brands)) {
            $brandId = explode(',', $request->brands);
            $query->whereIn('marca_id', $brandId);
        }

        $producto  = $query->Paginate(12);

        return view('front/products.index', compact('categorias', 'marcas', 'producto', 'data', 'colores', 'tamanos', 'coleccion_mujer'));
    }

    public function productDetalles($slug)
    {

        $producto = Producto::with(['colors', 'tamanos', 'reviews'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $userHasPurchased = false;
        $userOrderId = null;

        if (Auth::check()) {
            $orderItem = OrderItem::where('product_id', $producto->id)
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })->first();

            if ($orderItem) {
                $userHasPurchased = true;
                $userOrderId = $orderItem->order_id;
            }
        }

        $averageRating = $producto->reviews->avg('rating') ?? 0;
        $averageRating = round($averageRating, 1); // Redondear a 1 decimal

        $producto_relacionados = Producto::where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $producto->id)
            ->where('status', 1)
            ->latest()
            ->take(20)
            ->get();

        $producto_galeria = DB::table('galerias')
            ->where('producto_id', $producto->id)
            ->get();

        return view(
            'front/products.detalles',
            compact('producto', 'producto_relacionados', 'producto_galeria', 'userHasPurchased', 'userOrderId', 'averageRating')
        );
    }


    /*     public function productByCategory(Request $request, $slug)
    {
        $categorias = Categoria::from('categorias as c')
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
        ->orderBy('t.p_cat_id')
        ->get();

         // Consulta para el Sidebar: Colección Mujer
        $coleccion_mujer = Categoria::where('tipo_id', 20)
        ->where('status', 1)
        ->where('destacado', 1)
        ->withCount('productos') // Esto crea automáticamente la variable productos_count
        ->orderBy('nombre', 'ASC')
        ->get();

        $marcas = Marca::where('status', 1)->get();
        $colores = Color::all();
        $tamanos = Tamano::all();

        //$selectedCat = Categoria::where('status', 1)->where('slug', $slug)->first();

        $selectedCat = Categoria::with('tipo') // Agregamos la carga de la relación
        ->where('status', 1)
        ->where('slug', $slug)
        ->first();

        // 1. Si la categoría no existe, redirige o lanza un 404 elegante
        if (!$selectedCat) {
            abort(404, 'La categoría no existe o ha sido movida.');
        }

        $query = Producto::where('status', 1)->where('categoria_id', $selectedCat->id)->orderBy('id', 'DESC');

        if ($request->has('keywords') && !empty($request->keywords)) {
            $query->where('nombre', 'LIKE', '%' . $request->keywords . '%');
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->where('categoria_id', $request->category);
        }

        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('precio', '>=', $request->min_price);
        }

        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('precio', '<=', $request->max_price);
        }

        if ($request->has('brands') && !empty($request->brands)) {
            $brandId = explode(',', $request->brands);
            $query->whereIn('marca_id', $brandId);
        }

        $producto  = $query->Paginate(6);

        return view('front.products.bycategory', compact('categorias', 'marcas', 'producto', 'selectedCat', 'colores', 'tamanos', 'coleccion_mujer'));
    }
 */

    public function productByCategory(Request $request, $tipo, $slug)
    {
        // 1. Buscamos la categoría validando el SLUG y el TIPO simultáneamente
        $selectedCat = Categoria::with('tipo')
            ->whereHas('tipo', function ($q) use ($tipo) {
                $q->where('p_cat_name', $tipo); // Valida que el tipo en la URL coincida con la BD
            })
            ->where('status', 1)
            ->where('slug', $slug)
            ->first();

        // 2. Validación de seguridad para evitar el error "property id on null"
        if (!$selectedCat) {
            abort(404, 'La categoría solicitada no existe para este catálogo.');
        }

        // --- Consultas para el Sidebar y Filtros ---

        $categorias = Categoria::from('categorias as c')
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
            ->orderBy('t.p_cat_id')
            ->get();

        // Colección Mujer (ID 20)
        $coleccion_mujer = Categoria::where('tipo_id', 20)
            ->where('status', 1)
            ->where('destacado', 1)
            ->withCount('productos')
            ->orderBy('nombre', 'ASC')
            ->get();

        $marcas = Marca::where('status', 1)->get();
        $colores = Color::all();
        $tamanos = Tamano::all();

        // --- Lógica de Filtros de Productos ---

        $query = Producto::where('status', 1)
            ->where('categoria_id', $selectedCat->id)
            ->orderBy('id', 'DESC');

        if ($request->filled('keywords')) {
            $query->where('nombre', 'LIKE', '%' . $request->keywords . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('precio', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('precio', '<=', $request->max_price);
        }

        if ($request->filled('brands')) {
            $brandId = explode(',', $request->brands);
            $query->whereIn('marca_id', $brandId);
        }

        $producto = $query->paginate(6);

        // Retornamos la vista con todos los datos necesarios
        return view('front.products.bycategory', compact(
            'categorias',
            'marcas',
            'producto',
            'selectedCat',
            'colores',
            'tamanos',
            'coleccion_mujer'
        ));
    }
}
