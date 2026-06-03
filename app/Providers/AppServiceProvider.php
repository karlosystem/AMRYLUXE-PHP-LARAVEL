<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Compartir datos con TODAS las vistas
        View::composer('*', function ($view) {
            
            // 1. Cargamos las categorías usando 'with' para que la relación 'tipo' esté disponible
            // Esto es vital para que route('products.byCategory', [$item->tipo->p_cat_name, $item->slug]) funcione.
            
            $view->with('menu_damas', Categoria::with('tipo')
                ->where('tipo_id', 20) 
                ->where('status', 1)
                ->orderBy('nombre', 'ASC')
                ->limit(30)->get());

            $view->with('menu_hombres', Categoria::with('tipo')
                ->where('tipo_id', 21) 
                ->where('status', 1)
                ->orderBy('nombre', 'ASC')
                ->limit(30)->get());

            $view->with('menu_ninos', Categoria::with('tipo')
                ->where('tipo_id', 22) 
                ->where('status', 1)
                ->orderBy('nombre', 'ASC')
                ->limit(30)->get());

            $view->with('menu_accesorios', Categoria::with('tipo')
                ->where('tipo_id', 25) 
                ->where('status', 1)
                ->orderBy('nombre', 'ASC')
                ->limit(30)->get());

            // 2. Cargamos los banners/imágenes de los tipos de categoría
            $view->with('menu_dama_imagen', DB::table('tipo_categorias')->where('p_cat_id', 20)->first());
            $view->with('menu_hombre_imagen', DB::table('tipo_categorias')->where('p_cat_id', 21)->first());
            $view->with('menu_ninos_imagen', DB::table('tipo_categorias')->where('p_cat_id', 22)->first());
            $view->with('menu_accesorios_imagen', DB::table('tipo_categorias')->where('p_cat_id', 25)->first());
        });
    }
}