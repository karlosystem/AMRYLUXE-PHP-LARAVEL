<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoriaController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SubscribersController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\TrackingController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Frontend\ReclamacionesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

// 1. CONFIGURACIÓN Y LOCALIZACIÓN
Route::get('/locale/{lang}', function ($lang) {
    if (!in_array($lang, ['esp', 'eng'])) {
        abort(400);
    }
    Session::put('locale', $lang);
    App::setLocale($lang);
    return redirect()->back();
});

// 2. RUTAS ESTÁTICAS DEL FRONT END (HOME Y PÁGINAS)
Route::get('/', [WelcomeController::class, 'index'])->name('home.index');
Route::get('/acerca', [PagesController::class, 'acercaDe'])->name('acerca.de');
Route::get('/historia', [PagesController::class, 'historia'])->name('historia');
Route::get('/tienda', [PagesController::class, 'tienda'])->name('tienda');
Route::get('/eventos', [PagesController::class, 'eventos'])->name('eventos');
Route::get('/clientes', [PagesController::class, 'clientes'])->name('clientes');
Route::get('/contactenos', [PagesController::class, 'contactenos'])->name('contactenos');
Route::post('/contactenos', [PagesController::class, 'storeContactenos'])->name('contactenos.store');
Route::get('/preguntas', [PagesController::class, 'preguntas'])->name('preguntas');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categoria.todos');
Route::get('/terminos', [PagesController::class, 'terminosCondiciones'])->name('terminos.condiciones');
Route::get('/privacidad', [PagesController::class, 'politicasPrivacidad'])->name('politicas.privacidad');
Route::get('/liquidacion', [PagesController::class, 'liquidacion'])->name('liquidacion');
Route::get('/reclamaciones', [ReclamacionesController::class, 'reclamaciones'])->name('reclamaciones');

// Ruta para procesar el envío del formulario
Route::post('/reclamaciones/guardar', [ReclamacionesController::class, 'store'])->name('reclamaciones.store');


// 3. PRODUCTOS (RUTAS CON PREFIJOS ESTÁTICOS)
Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/producto/{slug}', [ProductController::class, 'productDetalles'])->name('products.detalles');

// 4. FUNCIONALIDADES DE TIENDA (COMPARE, WISHLIST, CART, CHECKOUT)
Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');
Route::post('/compare/add/', [CompareController::class, 'addToCompare'])->name('compare.add');
Route::delete('/compare/remove/{id}', [CompareController::class, 'remove'])->name('compare.remove');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/', [WishlistController::class, 'addToWishList'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/increase', [CartController::class, 'cartIncrease'])->name('cart.increase');
Route::post('/cart/decrease', [CartController::class, 'cartDecrease'])->name('cart.decrease');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// 5. ÓRDENES Y SUSCRIPCIONES
Route::post('/subscribe', [SubscribersController::class, 'store'])->name('subscribers.store');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order-tracking/{number}', [TrackingController::class, 'orderTracking'])->name('order.track');
Route::get('/order-invoice/{id}', [OrderController::class, 'invoice'])->name('order.invoice');
Route::get('/checkout/success/{order}', [OrderController::class, 'orderSuccess'])->name('checkout.success');

// 6. UTILIDADES API/AJAX
Route::get('/get-states/{departament_id}', [CheckoutController::class, 'getStates']);
Route::get('/get-districts/{province_id}', [CheckoutController::class, 'getDistricts']);
Route::get('/get-department-tax/{department_id}', [CheckoutController::class, 'getDepartmentTax']);

// 7. AUTENTICACIÓN (Prioridad alta)
// Ruta para mostrar el formulario (GET)
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el inicio de sesión (POST) - ESTA ES LA QUE FALTA
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

// AÑADE ESTA LÍNEA PARA EL LOGOUT
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Rutas de administración con prefijo
Route::group(['prefix' => 'admin'], function() {
    // Desactivamos 'login' aquí porque ya lo definimos arriba de forma global
    Auth::routes(['login' => false]); 
});

// 8. RUTAS DE USUARIO Y SERVICIOS EXTERNOS
Route::prefix('user')->middleware('auth')->group(function(){
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('/order-details/{id}', [UserController::class, 'orderDetails'])->name('user.order.details');
    Route::get('/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/reviews', [UserController::class, 'reviews'])->name('user.reviews');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password');
});

// Rutas de Google Socialite
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::post('/coupon/apply', [CouponController::class, 'applyCoupon']);
Route::post('/review-store', [ReviewController::class, 'store'])->name('review.store');

// 9. RUTA DINÁMICA FINAL CON FILTRO DE SEGURIDAD
// Este 'where' prohíbe que esta ruta se active si la URL empieza con palabras reservadas
Route::get('/{tipo}/{slug}', [ProductController::class, 'productByCategory'])
    ->name('products.byCategory')
    ->where('tipo', '^(?!login|admin|user|productos|cart|checkout|auth|locale).*$');