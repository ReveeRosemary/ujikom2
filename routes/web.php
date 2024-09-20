<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PesananController;

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

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::middleware('auth')->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/detil_produk/{id}', [ProductController::class, 'show'])->name('product.details');
    

    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
});
