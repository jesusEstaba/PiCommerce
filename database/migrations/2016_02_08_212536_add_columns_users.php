<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('first_name');
            $table->text('last_name');
            $table->text('company')->nullable();
            $table->integer('street_number');
            $table->text('street_name');
            $table->text('aparment')->nullable();
            $table->text('aparment_complex')->nullable();
            $table->text('complex_name')->nullable();
            $table->integer('zip_code')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('country')->nullable();
            $table->text('special_directions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
