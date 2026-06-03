<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonioController;
use App\Http\Controllers\Admin\MarcaController;
use App\Http\Controllers\Admin\PaginasController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\ProvinciaController;
use App\Http\Controllers\Admin\DistritoController;
use App\Http\Controllers\Admin\GatewaysController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ReclamacionesController;
use App\Http\Controllers\Admin\ProductoGaleriaController;


Route::prefix('admin')->name('admin.')->group(function () {

    // Rutas de Autenticación
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Rutas protegidas por el Middleware auth:admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // contactenos
        Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
        Route::delete('contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

        // subscribers
        Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index');
        Route::delete('subscribers/{id}', [SubscribersController::class, 'destroy'])->name('subscribers.destroy');

        // banners
        Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update');
        Route::get('sliders/{id}', [SliderController::class, 'show'])->name('sliders.show');
        Route::delete('sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');

        // F.A.Q.
        Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
        Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
        Route::post('faqs', [FaqController::class, 'store'])->name('faq.store');
        Route::get('faqs/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
        Route::put('faqs/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::get('faqs/{id}', [FaqController::class, 'show'])->name('faq.show');
        Route::delete('faqs/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');

        // Testimonios
        Route::get('testimonio', [TestimonioController::class, 'index'])->name('testimonio.index');
        Route::get('testimonio/create', [TestimonioController::class, 'create'])->name('testimonio.create');
        Route::post('testimonios', [TestimonioController::class, 'store'])->name('testimonio.store');
        Route::get('testimonios/{testimonio}/edit', [TestimonioController::class, 'edit'])->name('testimonio.edit');
        Route::put('testimonios/{testimonio}', [TestimonioController::class, 'update'])->name('testimonio.update');
        Route::get('testimonios/{id}', [TestimonioController::class, 'show'])->name('testimonio.show');
        Route::delete('testimonios/{id}', [TestimonioController::class, 'destroy'])->name('testimonio.destroy');

        // Categorias
        Route::get('categoria', [CategoriaController::class, 'index'])->name('categorias.index');
        Route::get('categoria/create', [CategoriaController::class, 'create'])->name('categoria.create');
        Route::post('categorias', [CategoriaController::class, 'store'])->name('categoria.store');
        Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
        Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');
        Route::delete('categorias/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

        // Marcas
        Route::get('marca', [MarcaController::class, 'index'])->name('marcas.index');
        Route::get('marca/create', [MarcaController::class, 'create'])->name('marcas.create');
        Route::post('marcas', [MarcaController::class, 'store'])->name('marcas.store');
        Route::get('marca/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
        Route::put('marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
        Route::delete('marcas/{id}', [MarcaController::class, 'destroy'])->name('marcas.destroy');

        // Paginas
        Route::get('pagina', [PaginasController::class, 'index'])->name('paginas.index');
        Route::get('pagina/create', [PaginasController::class, 'create'])->name('paginas.create');
        Route::post('paginas', [PaginasController::class, 'store'])->name('paginas.store');
        Route::get('pagina/{pagina}/edit', [PaginasController::class, 'edit'])->name('paginas.edit');
        Route::put('paginas/{pagina}', [PaginasController::class, 'update'])->name('paginas.update');
        Route::delete('paginas/{id}', [PaginasController::class, 'destroy'])->name('paginas.destroy');

        // Configuración
        Route::get('configuracion', [ConfiguracionController::class, 'edit'])->name('configuracion.edit');
        Route::put('configuracion/{id}', [ConfiguracionController::class, 'update'])->name('configuracion.update');

        // Coupons
        Route::get('coupon', [CouponController::class, 'index'])->name('coupon.index');
        Route::get('coupon/create', [CouponController::class, 'create'])->name('coupon.create');
        Route::post('coupon', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('coupon/{coupon}/edit', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::put('coupon/{coupon}', [CouponController::class, 'update'])->name('coupon.update');
        Route::delete('coupon/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');


        // admins
        Route::get('admin', [AdminController::class, 'index'])->name('users.index');
        Route::get('admin/create', [AdminController::class, 'create'])->name('users.create');
        Route::post('admin', [AdminController::class, 'store'])->name('users.store');
        Route::get('admin/{admin}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::put('admin/{admin}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('admin/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

        // Pasarelas de Pago
        Route::get('gateways/edit', [GatewaysController::class, 'edit'])->name('gateways.edit');
        Route::put('gateways', [GatewaysController::class, 'update'])->name('gateways.update');

        // users
        Route::get('clientes', [ClientesController::class, 'index'])->name('clientes.index');
        Route::delete('clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

        // ordenes
        Route::get('ordenes', [OrderController::class, 'index'])->name('ordenes.index');
        // Detalle de la orden
        Route::get('ordenes/{id}', [OrderController::class, 'show'])->name('ordenes.show');

        // Generar PDF de la guía
        Route::get('ordenes/{id}/pdf', [OrderController::class, 'generatePDF'])->name('ordenes.pdf');

        // Actualizar estado de la orden
        Route::put('ordenes/{id}/update-status', [OrderController::class, 'updateStatus'])->name('ordenes.updateStatus');

        //Departamentos
        Route::get('departamentos', [DepartamentoController::class, 'index'])->name('departamentos.index');
        Route::get('departamento/{departamento}/edit', [DepartamentoController::class, 'edit'])->name('departamentos.edit');
        Route::put('departamento/{departamento}', [DepartamentoController::class, 'update'])->name('departamentos.update');

        // Provincias
        Route::get('provincias', [ProvinciaController::class, 'index'])->name('provincias.index');
        Route::get('provincias/{provincia}/edit', [ProvinciaController::class, 'edit'])->name('provincias.edit');
        Route::put('provincias/{provincia}', [ProvinciaController::class, 'update'])->name('provincias.update');

        // Distritos
        Route::get('distritos', [DistritoController::class, 'index'])->name('distritos.index');
        Route::get('distritos/{distrito}/edit', [DistritoController::class, 'edit'])->name('distritos.edit');
        Route::put('distritos/{distrito}', [DistritoController::class, 'update'])->name('distritos.update');

        // Transacciones
        Route::get('transacciones', [OrderController::class, 'index'])->name('transacciones.index');

        // Proveedores
        Route::get('proveedores', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('proveedores/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('proveedor', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('proveedor/{proveedor}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('proveedores/{proveedor}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('proveedor/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

        // Libro de Reclamaciones
        Route::get('reclamaciones', [ReclamacionesController::class, 'index'])->name('reclamaciones.index');
        Route::post('reclamaciones/cambiar-estado/{id}', [ReclamacionesController::class, 'changeStatus'])->name('reclamaciones.changeStatus');
        Route::get('reclamaciones/detalle/{id}', [ReclamacionesController::class, 'getDetalle'])->name('reclamaciones.detalle');

        // Productos
        Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('producto', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('producto/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('producto/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('producto/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

        Route::get('productos/{id}/galeria', [ProductoGaleriaController::class, 'index'])->name('productos.galeria');
        Route::post('productos/{id}/galeria', [ProductoGaleriaController::class, 'store'])->name('productos.galeria.store');
        Route::delete('galeria/{id}', [ProductoGaleriaController::class, 'destroy'])->name('productos.galeria.destroy');
        Route::post('galeria/reordenar', [ProductoGaleriaController::class, 'reordenar'])->name('productos.galeria.reordenar');


        // Ruta para el selector dinámico de categorías (AJAX)
        Route::get('get-categorias/{tipo_id}', [ProductoController::class, 'getCategorias'])->name('get.categorias');

        // Ruta para el AJAX de categorías dinámicas
        Route::get('get-categorias-by-tipo', [ProductoController::class, 'getCategoriasByTipo'])->name('get_categorias_by_tipo');

    });
});
