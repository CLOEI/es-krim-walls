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
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->integer('carton')->default(0);
            $table->integer('piece')->default(0);
            $table->integer('piece_per_carton')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->integer('quantity')->default(0);
            $table->dropColumn('carton');
            $table->dropColumn('piece');
            $table->dropColumn('piece_per_carton');
        });
    }
};
