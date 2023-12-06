<?php

use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/loja', [HomeController::class, 'store'])->name('store');
Route::get('/cadastrar', [LoginController::class, 'register'])->name('register');
Route::get('/entrar', [LoginController::class, 'login'])->name('login');
Route::get('/esqueceu-sua-senha', [LoginController::class, 'forgotPassword'])->name('forgot-password');
