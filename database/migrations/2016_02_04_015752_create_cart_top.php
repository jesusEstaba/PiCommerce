<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_top', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_cart');
            $table->bigInteger('id_topping');
            $table->bigInteger('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart_top');
    }
}
