<?php

class HelperWebInfo
{
    public static function configMessage($property)
    {
        return DB::table('config')
            ->where('Cfg_Descript', $property)
            ->first()
            ->Cfg_Message;
    }

    public static function logo()
    {
        return Static::configMessage('logo');
    }

    public static function footer()
    {
        return Static::configMessage('footer');
    }

    public static function facebookLink()
    {
        return Static::configMessage('facebook');
    }

    public static function instagramLink()
    {
        return Static::configMessage('instagram');
    }

    public static function twitterLink()
    {
        return Static::configMessage('twitter');
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

    public static function coordinates()
    {
        return Static::configMessage('Coordinates');
    }
}