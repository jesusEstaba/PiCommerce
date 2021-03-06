<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('id_user');
            $table->bigInteger('product_id');
            $table->longText('cooking_instructions');
        });

        Schema::create('category', function (Blueprint $table) {
            $table->text('nano');
        });

        Schema::create('flights', function (Blueprint $table) {
            $table->text('nano');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart');
    }
}
