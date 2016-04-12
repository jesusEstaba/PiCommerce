<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedProductsFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('size_id')->default(0);
            $table->integer('special_order');
        });
        /*
        Schema::table('items', function ($table) {
            $table->dropColumn('It_Feature');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_features');
    }
}
