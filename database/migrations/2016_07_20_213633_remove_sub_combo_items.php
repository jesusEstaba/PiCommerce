<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSubComboItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_items', function (Blueprint $table) {
            $table->dropColumn('CbI_Sub');
            $table->dropColumn('CbI_Size');
        });
        Schema::table('combo_items', function (Blueprint $table) {
            $table->bigInteger('CbI_Size')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo_items', function (Blueprint $table) {
            //
        });
    }
}
