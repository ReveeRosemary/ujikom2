<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes (not protected by middleware)
Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/detil_produk/{id}', [ProductController::class, 'show'])->name('product.details');
    Route::get('/pesanan', [ProductController::class, 'pesanan'])->name('product.pesanan');
    
    // Cart and Checkout routes
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart.index');
    Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [ProductController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [ProductController::class, 'checkout'])->name('cart.checkout');
});
