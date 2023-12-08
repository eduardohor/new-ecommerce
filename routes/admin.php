<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/painel', [DashboardController::class, 'index'])->name('dashboard.index');
