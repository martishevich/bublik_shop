<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_prods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedInteger('product_id');
            $table->string('title');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_prods');
    }
}
