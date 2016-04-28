<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Cfg_Descript');
            $table->text('Cfg_Message');
            $table->integer('Cfg_Value1')->default(0);
            $table->integer('Cfg_Value2')->default(0);
            $table->time('Cfg_Open');
            $table->time('Cfg_Close');
            $table->boolean('Cfg_Status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config');
    }
}
