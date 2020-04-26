<?php

use App\Http\Controllers\CartCTRL;

class HelperMenu
{
    public static function categoryList()
    {
        $categorys = DB::table('groups')
            ->where('Gr_Status', 0)
            ->select(
                'Gr_Url as url',
                'Gr_Descrip as name'
            )
            ->get();

        return $categorys;
    }

    public static function totalInCart()
    {
        return CartCTRL::totalCostCart();
    }
}