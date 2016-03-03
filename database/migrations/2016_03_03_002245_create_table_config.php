<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->boolean('closed')->default(false);
            $table->time('mon_open')->default('00:00:00');
            $table->time('mon_close')->default('24:00:00');

            $table->time('tue_open')->default('00:00:00');
            $table->time('tue_close')->default('24:00:00');

            $table->time('wed_open')->default('00:00:00');
            $table->time('wed_close')->default('24:00:00');

            $table->time('thu_open')->default('00:00:00');
            $table->time('thu_close')->default('24:00:00');

            $table->time('fri_open')->default('00:00:00');
            $table->time('fri_close')->default('24:00:00');

            $table->time('sat_open')->default('00:00:00');
            $table->time('sat_close')->default('24:00:00');

            $table->time('sun_open')->default('00:00:00');
            $table->time('sun_close')->default('24:00:00');
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
