<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/loja', [HomeController::class, 'store'])->name('store');
Route::get('/cadastrar', [LoginController::class, 'register'])->name('register');
Route::get('/entrar', [LoginController::class, 'login'])->name('login');
Route::get('/esqueceu-sua-senha', [LoginController::class, 'forgotPassword'])->name('forgot-password');

Route::get('/produto', [ProductController::class, 'index'])->name('product.index');

Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
