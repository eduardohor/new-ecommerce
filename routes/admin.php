<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/painel', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/cadastro', [CategoryController::class, 'create'])->name('categories.create');

Route::get('/produtos/cadastro', [ProductController::class, 'create'])->name('products.create');
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');
