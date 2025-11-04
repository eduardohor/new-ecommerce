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
        Schema::create('free_shipping_zip_ranges', function (Blueprint $table) {
            $table->id();
            $table->string('zip_start', 8)->comment('CEP inicial da faixa (somente números)');
            $table->string('zip_end', 8)->comment('CEP final da faixa (somente números)');
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Índices para melhor performance nas consultas
            $table->index(['zip_start', 'zip_end', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_shipping_zip_ranges');
    }
};
