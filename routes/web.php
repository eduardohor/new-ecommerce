<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
  require __DIR__ . '/front.php';
});

Route::group(['prefix' => 'admin'], function () {
  require __DIR__ . '/admin.php';
});
