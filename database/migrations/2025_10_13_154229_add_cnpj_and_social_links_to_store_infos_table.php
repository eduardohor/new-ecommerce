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
            $table->string('cnpj', 18)->nullable()->after('contact_number');
            $table->string('facebook_url')->nullable()->after('cnpj');
            $table->string('x_url')->nullable()->after('facebook_url');
            $table->string('instagram_url')->nullable()->after('x_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_infos', function (Blueprint $table) {
            $table->dropColumn(['cnpj', 'facebook_url', 'x_url', 'instagram_url']);
        });
    }
};
