<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClaimController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Rutas Web)
|--------------------------------------------------------------------------
| ES: Aquí registramos las rutas de la aplicación web. Son cargadas por
|     RouteServiceProvider y todas tienen asignado el middleware "web".
| EN: Here is where we register web routes for the application. These
|     routes are loaded by RouteServiceProvider and all get the "web" middleware.
*/

// =========================================================================
// 1. INICIO Y PANEL DE USUARIO (HOME & USER DASHBOARD)
// =========================================================================

// ES: Ruta principal que carga la vista de bienvenida (Landing Page)
// EN: Main route that loads the welcome view (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// ES: Panel del cliente, protegido por "auth" (autenticado) y "verified" (correo verificado)
// EN: Customer dashboard, protected by "auth" (authenticated) and "verified" (verified email)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// =========================================================================
// 2. PERFIL DE USUARIO - AUTENTICADO (USER PROFILE - AUTHENTICATED)
// =========================================================================
Route::middleware('auth')->group(function () {
    // ES: Formulario para editar el perfil del usuario / EN: Edit profile form
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // ES: Procesar actualización del perfil / EN: Process profile update
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // ES: Eliminar la cuenta de usuario / EN: Delete user account
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ES: Cargar rutas de autenticación de Laravel Breeze (login, registro, password, etc.)
// EN: Load Laravel Breeze authentication routes (login, register, password reset, etc.)
require __DIR__.'/auth.php';

// =========================================================================
// 3. TIENDA PÚBLICA: CATEGORÍAS Y PRODUCTOS (PUBLIC STORE: CATEGORIES & PRODUCTS)
// =========================================================================

// ES: Rutas tipo Resource para Categorías y Productos (Index, Show, etc.)
// EN: Resource routes for Categories and Products (Index, Show, etc.)
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

// =========================================================================
// 4. CARRITO DE COMPRAS (SHOPPING CART)
// =========================================================================

// ES: Ver el contenido del carrito / EN: View cart content
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
// ES: Añadir un producto al carrito (petición POST con el ID del producto)
// EN: Add a product to the cart (POST request with the product ID)
Route::post('cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
// ES: Actualizar cantidad de un producto / EN: Update product quantity
Route::put('cart/{cart}', [CartController::class, 'update'])->name('cart.update');
// ES: Eliminar un producto del carrito / EN: Remove a product from the cart
Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

// =========================================================================
// 5. PEDIDOS (ORDERS) - REQUIERE AUTENTICACIÓN
// =========================================================================

// ES: Mapea index (listar pedidos), show (ver detalle), create (checkout) y store (guardar pedido)
// EN: Maps index (list orders), show (view details), create (checkout) and store (save order)
Route::resource('orders', OrderController::class)->only(['index', 'show', 'store', 'create'])->middleware('auth');

// =========================================================================
// 6. LIBRO DE RECLAMACIONES / CONTACTO (CLAIMS BOOK / CONTACT)
// =========================================================================

// ES: Formulario para registrar una queja o reclamo / EN: Form to file a complaint
Route::get('contacto', [ClaimController::class, 'create'])->name('claims.create');
// ES: Enviar y guardar la queja en la base de datos / EN: Submit and store the complaint
Route::post('contacto', [ClaimController::class, 'store'])->name('claims.store');

// =========================================================================
// 7. MÓDULO DE ADMINISTRACIÓN (ADMIN MODULE)
// =========================================================================

// ES: Grupo de rutas protegidas por los middlewares 'auth' (iniciado sesión) y 'admin' (rol administrador)
// EN: Group of routes protected by 'auth' (logged in) and 'admin' (admin role) middlewares
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ES: Panel principal del administrador / EN: Admin main dashboard
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    // ES: CRUD de productos del administrador / EN: Product CRUD for the administrator
    Route::resource('products', \App\Http\Controllers\Admin\AdminProductController::class);
    // ES: Listar todas las quejas registradas / EN: List all filed complaints
    Route::get('claims', [\App\Http\Controllers\Admin\AdminClaimController::class, 'index'])->name('claims.index');
    // ES: Marcar queja como resuelta / EN: Mark a complaint as resolved
    Route::put('claims/{claim}/resolve', [\App\Http\Controllers\Admin\AdminClaimController::class, 'resolve'])->name('claims.resolve');
    
    Route::view('production', 'admin.production')->name('production.index');
});

// Ruta mágica para Render (como no tienes acceso al shell en la capa gratuita)
Route::get('/instalar-bd', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        return "¡Base de datos instalada y poblada con éxito! Ya puedes entrar al sistema.";
    } catch (\Exception $e) {
        return "Error al instalar: " . $e->getMessage();
    }
});
