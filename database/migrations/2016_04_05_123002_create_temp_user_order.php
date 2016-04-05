<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempUserOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_user_order', function (Blueprint $table) {
            $table->increments('id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('phone');
            $table->text('email');
            $table->integer('order_id');
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
        Schema::drop('temp_user_order');
    }
}
