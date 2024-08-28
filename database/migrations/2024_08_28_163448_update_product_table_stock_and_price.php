<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('stocks_id')->nullable()->change();
            $table->unsignedBigInteger('prices_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('stocks_id')->nullable(false)->change();
            $table->unsignedBigInteger('prices_id')->nullable(false)->change();
        });
    }
};
