<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxiProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxi_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tp_product');
            $table->foreign('tp_product')->references('id')->on('products');
            $table->integer('tp_amount');
            $table->unsignedBigInteger('tp_taxi');
            $table->foreign('tp_taxi')->references('id')->on('taxis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxi_products');
    }
}
