<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/painel', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/categorias', [CategoryController::class, 'index'])->name('category.index');
Route::get('/produtos', [ProductController::class, 'index'])->name('product.index');
