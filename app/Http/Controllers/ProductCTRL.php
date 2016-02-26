<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;

class ProductCTRL extends Controller
{
    /**
     * [index description]
     * @param  [type] $cat [description]
     * @param  [type] $id  [description]
     * @return [type]      [description]
     */
    public function index($cat, $id)
    {	
        $items = DB::table('items')
            ->where('It_Id', $id)
            ->where('It_Status', 0)
            ->select('items.It_Groups', 'items.It_Descrip', 'items.It_Id', 'items.description')
            ->get();


    	if($items)
    	{
    		$name = $items[0]->It_Descrip;
    		$id_item = $items[0]->It_Id;
            $description = $items[0]->description;
            $It_Groups = $items[0]->It_Groups;

    		$size_t = DB::table('size')
                ->where('Sz_Item', $id_item)
                ->where('Sz_Status', 0)
                ->get();

            
            ###############################
            $type_category = 1;############
            ###############################
            ###############################
            #
            #CATEGORIA
            #
            ###############################
            
            $toppings = DB::table('toppings')
                ->where('Tp_Kind', $type_category)
                ->where('Tp_Abrev', '!=', '.')
                ->where('Tp_Cat', 0)
                ->select('Tp_Id', 'TP_Descrip', 'Tp_Cat')
                ->orderBy('Tp_Cat')
                ->get();
    	}
    	

    	//Valores por defecto
    	if( !isset($name) )
    		$name = "Product";
    	if( !isset($size_t) )
    		$size_t = "";
        if(!isset($toppings))
            $toppings = "";
        if(!isset($It_Groups))
            $It_Groups = "";



        if($size_t)
        {   
            if($It_Groups==1 or $It_Groups==13)
            {
                $image_category = 'healthy-honey-vegetable-pizza-561561.jpg';
                if($It_Groups==13)
                {
                    $image_category ='calzone_jamon_300x200.png';
                }
                
                #VIEW
                $vista = 'builder.pizza';
                    
            }
            else if($It_Groups==11 or $It_Groups==7)
            {
                $image_category = "xsLmTnr55b8xLnF72P2eYqV57bk.png";
                if($It_Groups==7)
                {
                    $image_category = "BBQ-Chicken-wings.jpg";
                }
                
                #VIEW
                $vista = 'builder.salad';
                
            }
            else if($It_Groups==9)
            {
                $image_category = "soft-drinks.jpg";
                
                #VIEW
                $vista = 'builder.simple'; 
            }

        }

        if ( isset($vista) )
        {
            return view($vista)->with([
                    'name'=>$name, 
                    'size'=>$size_t, 
                    'toppings'=>$toppings, 
                    'item'=>$items, 
                    'description'=>$description,
                    'image_category'=>$image_category
                ]);
        }

        return view('builder.generic_builder');
    	   
	}
}
