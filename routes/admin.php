<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FreeShippingZipRangeController;
use App\Http\Controllers\Admin\PriceAdjustmentController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\InstitutionalPageController;
use App\Http\Controllers\Admin\StoreInfoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
  Route::middleware('admin')->group(function () {
    Route::get('/painel', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/painel/receitas', [DashboardController::class, 'getRevenues'])->name('dashboard.revenues');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit.admin');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update.admin');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy.admin');

    Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categorias/cadastro', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categorias/cadastro', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categorias/{id}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categorias/{id}/editar', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorias/{id}/editar', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/cadastro', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/banners/cadastro', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/banners/{id}/editar', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/banners/{id}/editar', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{id}/editar', [BannerController::class, 'destroy'])->name('banners.destroy');

    Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');
    Route::get('/produtos/cadastro', [ProductController::class, 'create'])->name('products.create');
    Route::post('/produtos/cadastro', [ProductController::class, 'store'])->name('products.store');
    Route::get('/produtos/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produtos/edit/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produtos/edit/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/produtos/{product}/imagens/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
    Route::post('/produtos/{id}/duplicar', [ProductController::class, 'duplicate'])->name('products.duplicate');

    Route::get('/produtos/reajuste-preco', [PriceAdjustmentController::class, 'index'])->name('products.price-adjustment.index');
    Route::post('/produtos/reajuste-preco/preview', [PriceAdjustmentController::class, 'preview'])->name('products.price-adjustment.preview');
    Route::post('/produtos/reajuste-preco/aplicar', [PriceAdjustmentController::class, 'apply'])->name('products.price-adjustment.apply');

    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pedidos/novo/{customer}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/pedidos', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/pedidos/{order_nuber}/detalhes', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/pedidos/atualizar-status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
    Route::post('/pedidos/atualizar-anotacoes', [OrderController::class, 'updateNotes'])->name('orders.update.notes');
    Route::get('/pedidos/{order_number}/invoice', [OrderController::class, 'downloadInvoice'])->name('orders.download.invoice');
    Route::get('/pedidos/{order_number}/etiqueta', [OrderController::class, 'downloadShippingLabel'])->name('orders.download.shipping-label');
    Route::post('/pedidos/adicionar-codigo-rastreio', [OrderController::class, 'addTrackingCode'])->name('orders.add.tracking.code');

    Route::get('/clientes', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/clientes/cadastro', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/clientes/cadastro', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/clientes/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/clientes/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/clientes/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/clientes/{id}/endereco', [CustomerController::class, 'storeAddress'])->name('customers.store.address');
    Route::put('/clientes/endereco/{id}', [CustomerController::class, 'updateAddress'])->name('customers.update.address');
    Route::delete('/clientes/endereco/{id}', [CustomerController::class, 'destroyAddress'])->name('customers.destroy.address');
    Route::post('/clientes/{id}/pagamento', [CustomerController::class, 'storePayment'])->name('customers.store.payment');

    Route::resource('/cupons', CouponController::class)
      ->parameters(['cupons' => 'coupon'])
      ->names('coupons');

    // Frete Grátis - Faixas de CEP
    Route::resource('/frete-gratis/faixas-cep', FreeShippingZipRangeController::class)
      ->parameters(['faixas-cep' => 'free_shipping_zip_range'])
      ->names('admin.free-shipping-zip-ranges')
      ->except(['show']);
    Route::post('/frete-gratis/faixas-cep/{free_shipping_zip_range}/toggle', [FreeShippingZipRangeController::class, 'toggleActive'])
      ->name('admin.free-shipping-zip-ranges.toggle');

    Route::get('/loja-info', [StoreInfoController::class, 'show'])->name('store.info.show');
    Route::post('/loja-info', [StoreInfoController::class, 'saveOrUpdate'])->name('store.info.saveOrUpdate');

    Route::resource('/paginas-institucionais', InstitutionalPageController::class)
      ->parameters(['paginas-institucionais' => 'institutional_page'])
      ->names('institutional-pages');

    Route::prefix('/relatorios')->name('admin.reports.')->group(function () {
      Route::get('/vendas', [SalesReportController::class, 'index'])->name('sales.index');
      Route::get('/vendas/exportar/excel', [SalesReportController::class, 'exportExcel'])->name('sales.export.excel');
      Route::get('/vendas/exportar/pdf', [SalesReportController::class, 'exportPdf'])->name('sales.export.pdf');
    });

  });

  Route::middleware('super.admin')->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/cadastro', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/{id}/editar', [UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{id}/editar', [UserController::class, 'destroy'])->name('users.destroy');
  });
});
