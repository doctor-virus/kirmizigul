<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyings', function (Blueprint $table) {
            $table->id();
            $table->string('b_docment_id');
            $table->integer('b_amount');
            $table->double('b_price');
            $table->double('b_all_price');
            $table->unsignedBigInteger('b_product');
            $table->foreign('b_product')->references('id')->on('products');
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
        Schema::dropIfExists('buyings');
    }
}
