<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('store_infos', function (Blueprint $table) {
            $table->boolean('free_shipping_enabled')->default(false)->after('zip_code');
            $table->enum('free_shipping_type', ['zip_range', 'minimum_value', 'both'])->nullable()->after('free_shipping_enabled');
            $table->decimal('free_shipping_minimum_value', 10, 2)->nullable()->after('free_shipping_type')->comment('Valor mínimo do carrinho para frete grátis');
            $table->decimal('free_shipping_minimum_order', 10, 2)->nullable()->after('free_shipping_minimum_value')->comment('Valor mínimo do pedido para permitir frete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_infos', function (Blueprint $table) {
            $table->dropColumn([
                'free_shipping_enabled',
                'free_shipping_type',
                'free_shipping_minimum_value',
                'free_shipping_minimum_order'
            ]);
        });
    }
};
