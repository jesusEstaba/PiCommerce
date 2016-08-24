<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidaySchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_schedule', function (Blueprint $table) {
            $table->increments('HS_Id');
            $table->date('HS_Date');
            $table->string('HS_Title');
            $table->string('HS_Message');
            $table->string('HS_Banner');
            $table->string('HS_Background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('holiday_schedule');
    }
}
