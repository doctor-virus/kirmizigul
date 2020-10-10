<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->id();
            $table->string('s_name');
            $table->string('s_phone');
            $table->integer('s_amount');
            $table->double('s_price');
            $table->double('s_all_price');
            $table->text('s_address')->nullable();
            $table->boolean('s_state')->default(0);
            $table->unsignedBigInteger('s_taxi');
            $table->foreign('s_taxi')->references('id')->on('taxis');
            $table->unsignedBigInteger('s_product');
            $table->foreign('s_product')->references('id')->on('products');
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
        Schema::dropIfExists('sellings');
    }
}
