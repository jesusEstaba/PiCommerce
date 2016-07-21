<?php

class HelperWebInfo
{
    public static function logo()
    {
        $logo = DB::table('config')
            ->where('Cfg_Descript', 'logo')
            ->first()
            ->Cfg_Message;

        return $logo;
    }

    public static function footer()
    {
		return DB::table('config')
			->where('Cfg_Descript', 'footer')
			->first()
			->Cfg_Message;
    }

    public static function facebookLink()
    {
		return DB::table('config')
			->where('Cfg_Descript', 'facebook')
			->first()
			->Cfg_Message;
    }

    public static function instagramLink()
    {
		return DB::table('config')
			->where('Cfg_Descript', 'instagram')
			->first()
			->Cfg_Message;
    }

    public static function twitterLink()
    {
		return DB::table('config')
			->where('Cfg_Descript', 'twitter')
			->first()
			->Cfg_Message;
    }

    public static function tax()
    {
        $tax = DB::table('taxes')
            ->first()
            ->Tx_Base;
        
        if ($tax>0) {
            return $tax;
        }

        return 0;
    }

    public static function pizzaBuilderSize($itGroups)
    { 
        $isExist = DB::table('config')
            ->where('Cfg_Descript', 'Id Group Pizza Builder')
            ->where('Cfg_Value1', $itGroups)
            ->first();

        if ($isExist) {
            return true;
        }

        return false;
    }
}