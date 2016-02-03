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
            $name_cat = $consulta[0]->name;

            //$consulta[0]::append(['price' => '3']);
    		
            if($group_id)
    		{
    			$items = DB::select('SELECT items.It_Id, items.It_Descrip, size.Sz_Price, size.Sz_item
                    FROM items 
                    INNER JOIN size 
                    ON items.It_Id=size.Sz_item  
                    WHERE items.It_Groups = ? AND Sz_Special=1', [$group_id]
                );
    			
                //$items = $items[0];
    			
    			if($submenu_cat)
    			{
    				$id = $items[0]->It_Id;
    				$items = DB::select('SELECT Sz_Price, Sz_item, Sz_Descrip from size where Sz_Item = ?', [$id]);
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

        //return $items;

    	
        return view('category')->with([
            'categorys'=>$categorys, 'name_category'=>$name_cat,
            'name_cat_url'=>$name_category, 'banner'=>$banner, 
            'items'=>$items, 'sub'=>$submenu_cat
        ]);
        
    }
}
