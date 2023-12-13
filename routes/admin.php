<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
  Route::prefix('admin')->group(function () {
    Route::get('/painel', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categorias/cadastro', [CategoryController::class, 'create'])->name('categories.create');

    Route::get('/produtos/cadastro', [ProductController::class, 'create'])->name('products.create');
    Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pedidos/detalhes', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/clientes', [CustomerController::class, 'index'])->name('customers.index');
  });
});
