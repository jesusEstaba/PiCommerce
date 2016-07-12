<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComboItemsCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_items', function (Blueprint $table) {
            $table->increments('CbI_Id');
            $table->bigInteger('CbI_Combo');
            $table->bigInteger('CbI_Item');
            $table->bigInteger('CbI_Size');
            $table->boolean('CbI_Sub');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combo_items');
    }
}
