<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;

class CategoryCTRL extends Controller
{
    public function category($name_category)
    {
    	$name_category = strtolower($name_category);


    	$consulta = DB::select('select name, image_cat, group_id, submenu_cat from category where name_cat = ?', [$name_category]);
    	if($consulta)
    	{
    		$banner = $consulta[0]->image_cat;
    		$group_id = $consulta[0]->group_id;
    		$submenu_cat = $consulta[0]->submenu_cat;
            $name_category = $consulta[0]->name;

    		if($group_id)
    		{
    			$items = DB::select('select * from items where It_Groups = ?', [$group_id]);
    			//$items = $items[0];
    			
    			if($submenu_cat)
    			{
    				$id = $items[0]->It_Id;
    				$items = DB::select('select * from size where Sz_Item = ?', [$id]);
    			}
    		}
    	}
    	else
    	{
    		$banner = '7838a2f8-fb2d-48e8-abc9-f7db942d3ede.jpg';//donde no esta en la lista
    	}

    	if( !isset($items) )
    		$items = '';
    	if( !isset($submenu_cat) )
    		$submenu_cat = 0;


        $categorys = DB::select("select name,name_cat  from category");

    	return view('category')->with(['categorys'=>$categorys, 'name_category'=>$name_category, 'banner'=>$banner, 'items'=>$items, 'sub'=>$submenu_cat]);
    }
}
