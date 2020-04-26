<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    public static function message ($property) 
    {
    	$config = static::where('Cfg_Descript', $property)->first();

        return ($config) ? $config->Cfg_Message : '';
    }

    public static function value1 ($property) 
    {
    	$config = static::where('Cfg_Descript', $property)->first();

        return ($config) ? $config->Cfg_Value1 : 0;
    }

}
