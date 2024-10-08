<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\AddressController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FavoriteController;
use App\Http\Controllers\Front\StoreController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ShippingController;
use App\Http\Controllers\Front\WebhookController;
use Illuminate\Support\Facades\Route;


Route::get('/', [StoreController::class, 'home'])->name('home');
Route::get('/email', [StoreController::class, 'email'])->name('email');
Route::get('/loja', [StoreController::class, 'store'])->name('store');
Route::get('/lista-de-desejos', [StoreController::class, 'wishlist'])->name('wishlist');
Route::get('/pagina-nao-encontrada', [StoreController::class, 'pageNotFound'])->name('page-not-found');
Route::get('/adicionar-view-produto/{productId}', [StoreController::class, 'addViewProduct'])->name('add-view-product');

Route::get('categoria/{slug}', [CategoryController::class, 'categoryProducts'])->name('category-products');

Route::get('/produto/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/pesquisar-produtos', [ProductController::class, 'search'])->name('product.search');

Route::get('/carrinho', [CartController::class, 'show'])->name('cart.show');
Route::post('/adicionar-ao-carrinho', [CartController::class, 'addProductToCart'])->name('cart.add-product-to-cart');
Route::post('/remover-do-carrinho', [CartController::class, 'deleteProductToCart'])->name('cart.delete-product-to-cart');

Route::post('/calcular-frete', [ShippingController::class, 'calculateShipping'])->name('calculate-shipping');

Route::post('/webhook/mercadopago', [WebhookController::class, 'handleMercadoPago'])->name('webhook.mercadopago');

Route::middleware('auth')->group(function () {
    Route::get('/checkout-endereco', [CheckoutController::class, 'address'])->name('checkout.address');
    Route::post('/checkout-pagamento', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout-pagamento', [CheckoutController::class, 'showPaymentPage'])->name('checkout.payment');

    // Route::get('/pagamentos', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/pagamentos/processo', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/pagamentos/sucesso/{order_id}', [PaymentController::class, 'showPaymentSuccess'])->name('payment.success');
    Route::get('/pagamentos/falha/{transaction_id}', [PaymentController::class, 'showPaymentFailed'])->name('payment.failed');

    Route::post('/pedidos', [OrderController::class, 'store'])->name('order.store');

    Route::post('/favoritos/add/{productId}', [FavoriteController::class, 'add'])->name('favorites.add');
    Route::post('/favoritos/remove/{productId}', [FavoriteController::class, 'remove'])->name('favorites.remove');

    // Route::get('/notificacoes', [NotificationController::class, 'index'])->name('notification.index');

    Route::prefix('minha-conta')->group(function(){
        Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index.customer');
        Route::get('/pedidos/{order_number}', [OrderController::class, 'show'])->name('orders.show.customer');

        Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/enderecos', [AddressController::class, 'index'])->name('address.index');
        Route::post('/enderecos', [AddressController::class, 'store'])->name('address.store');
        Route::put('/enderecos/{id}', [AddressController::class, 'update'])->name('address.update');
        Route::delete('/enderecos/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
        Route::post('/address/{id}/set-default', [AddressController::class, 'setDefault'])->name('address.setDefault');

    });
});
