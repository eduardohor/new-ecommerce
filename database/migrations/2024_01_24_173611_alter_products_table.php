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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('units');
            $table->integer('quantity')->after('weight');
            $table->decimal('width', 10, 2)->after('quantity');
            $table->decimal('height', 10, 2)->after('width');
            $table->decimal('length', 10, 2)->after('height');
            $table->string('slug')->unique()->after('sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('units')->after('weight');
            $table->dropColumn('quantity');
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('length');
            $table->dropColumn('slug');
        });
    }
};
