<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

class CategoryCTRL extends Controller
{
    public function category($name_category)
    {
    	$name_category = strtolower($name_category);

    	if($name_category=='pizzas')
    		$banner = '3fbef54e0b946103d3b0bea136304ce9.png';
    	
    	elseif ($name_category=='pastas')
    		$banner = 'Pasta-1.jpg';

    	elseif ($name_category=='drinks')
    		$banner = 'b22.jpg';

    	elseif ($name_category=='calzon')
    		$banner = 'CALZONE_9226.jpg';

    	elseif ($name_category=='rolls')
    		$banner = 'AUSJIXj.jpg';

    	elseif ($name_category=='salads')
    		$banner = 'Salad_platter02_crop.jpg';

    	elseif ($name_category=='parm_subs')
    		$banner = '20140923-chicken-parm-recipe-38.jpg';

    	elseif ($name_category=='wings')
    		$banner = 'easy-honety-bbq-chicken-wings.jpg';

    	elseif ($name_category=='hot_subs')
    		$banner = '5045d41b-f275-4b3d-96d0-dc99c35bafa8.jpg';

    	elseif ($name_category=='desserts')
    		$banner = 'McAlisters-Product-Images_DESSERTS_New-York-Cheesecake.png';

    	elseif ($name_category=='cold_subs')
    		$banner = '04.jpg';

    	elseif ($name_category=='gyro_burger_wraps')
    		$banner = 'GyrosBurger.gif';

    	elseif ($name_category=='side_order')
    		$banner = 'Fotolia_37974430_M.jpg';

    	else
    		$banner = '';//donde no esta en la lista

    	return view('category')->with(['name_category'=>$name_category, 'banner'=>$banner]);
    }
}
