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
        $this->hourCloseInsert([
            'Monday' => '24:00:00',
            'Tuesday' => '24:00:00',
            'Wednesday' => '24:00:00',
            'Thursday' => '24:00:00',
            'Friday' => '24:00:00',
            'Saturday' => '24:00:00',
            'Sunday' => '24:00:00',
        ]);

        //General Config
        $this->descriptionInsert([
            'logo' => '',
            'footer' => '',
            'Background Login' => '',
            'Close Store' => 'Status : 0 = open, 1 = Close',
            'Message Close' => 'Website Is closed... Will be back soon',
            'facebook' => 'http://facebook.com',
            'instagram' => 'http://instagram.com',
            'twitter' => 'http://twitter.com',
            'Coordinates' => '9.779808,-63.196956',
            'Register Message' => 'welcome to diginos. We hope you like our site.',
            'Default Photo Group Item' => 'ecipe-no-photo.jpg',
            'Default Banner Group' => '7838a2f8-fb2d-48e8-abc9-f7db942d3ede.jpg',
        ]);

         DB::table('config')->insert([
            'Cfg_Descript' => 'Maximum Range Delivery',
            'Cfg_Message' => 'Sorry, you can not make deliveries it because it is not in our range',
            'Cfg_Value1' => 3,
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Max Cooking Instructions',
            'Cfg_Value1' => 1,
        ]);
        DB::table('config')->insert([
            'Cfg_Descript' => 'Id Topping Cooking Instructions',
            'Cfg_Value1' => 4,
        ]);
    }

    protected function descriptionInsert(array $values)
    {
        foreach ($values as $key => $value) {
            DB::table('config')->insert([
                'Cfg_Descript' => $key,
                'Cfg_Message' => $value,
            ]);
        }
    }

    protected function hourCloseInsert(array $values)
    {
        foreach ($values as $key => $value) {
            DB::table('config')->insert([
                'Cfg_Descript' => $key,
                'Cfg_Close' => $value,
            ]);
        }
    }
}
