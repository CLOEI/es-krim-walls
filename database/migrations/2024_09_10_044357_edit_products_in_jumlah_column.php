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
        Schema::table('product_in', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->integer('carton')->nullable();
            $table->integer('pcs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_in', function (Blueprint $table) {
            $table->dropColumn('carton');
            $table->dropColumn('pcs');
            $table->integer('quantity')->nullable();
        });
    }
};
