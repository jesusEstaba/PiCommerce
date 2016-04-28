<?php

use Illuminate\Database\Seeder;

class ConfigSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//Days of the week
        DB::table('config')->insert([
            'Cfg_Descript' => 'Monday',
			'Cfg_Close' => '24:00:00',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Tuesday',
			'Cfg_Close' => '24:00:00',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Wednesday',
			'Cfg_Close' => '24:00:00',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Thursday',
			'Cfg_Close' => '24:00:00',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Friday',
			'Cfg_Close' => '24:00:00',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Saturday',
			'Cfg_Close' => '24:00:00',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Sunday',
			'Cfg_Close' => '24:00:00',
        ]);
        //General Config

        DB::table('config')->insert([
            'Cfg_Descript' => 'Close Store',
			'Cfg_Message' => 'Status : 0 = open, 1 = Close',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Message Close
',
			'Cfg_Message' => 'Website Is closed... Will be back soon',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'facebook',
			'Cfg_Message' => 'http://facebook.com',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'instagram',
			'Cfg_Message' => 'http://instagram.com',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'twitter',
			'Cfg_Message' => 'http://twitter.com',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'logo',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'footer',
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Background Login',
        ]);
    }
}
