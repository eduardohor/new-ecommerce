<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
  Route::middleware('admin')->group(function () {
    Route::get('/painel', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit.admin');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update.admin');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy.admin');

    Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categorias/cadastro', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categorias/cadastro', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categorias/editar/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categorias/editar/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/produtos/cadastro', [ProductController::class, 'create'])->name('products.create');
    Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pedidos/detalhes', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/clientes', [CustomerController::class, 'index'])->name('customers.index');
  });

  Route::middleware('super.admin')->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/cadastro', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/editar/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/editar/{id}', [UserController::class, 'destroy'])->name('users.destroy');
  });
});
