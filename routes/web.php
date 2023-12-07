<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\StoreController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'home'])->name('home');
Route::get('/loja', [StoreController::class, 'store'])->name('store');
Route::get('/lista-de-desejos', [StoreController::class, 'wishlist'])->name('wishlist');
Route::get('/pagina-nao-encontrada', [StoreController::class, 'pageNotFound'])->name('page-not-found');

Route::get('/cadastrar', [LoginController::class, 'register'])->name('register');
Route::get('/entrar', [LoginController::class, 'login'])->name('login');
Route::get('/esqueceu-sua-senha', [LoginController::class, 'forgotPassword'])->name('forgot-password');

Route::get('/produto', [ProductController::class, 'index'])->name('product.index');

Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');

Route::get('/finalizar-compra', [CheckoutController::class, 'index'])->name('checkout.index');

Route::get('/pedidos', [OrderController::class, 'index'])->name('order.index');
