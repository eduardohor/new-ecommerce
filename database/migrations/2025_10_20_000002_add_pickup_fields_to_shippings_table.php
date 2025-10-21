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
        Schema::table('shippings', function (Blueprint $table) {
            $table->string('pickup_address')->nullable()->after('shipping_deadline');
            $table->string('pickup_hours')->nullable()->after('pickup_address');
            $table->text('pickup_instructions')->nullable()->after('pickup_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropColumn([
                'pickup_address',
                'pickup_hours',
                'pickup_instructions',
            ]);
        });
    }
};
