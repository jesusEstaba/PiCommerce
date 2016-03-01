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

            $builder_data = DB::table('category')
                ->where('group_id', $It_Groups)
                ->select('builder_id', 'image', 'tp_kind')
                ->get();
            
            if($builder_data)
            {
                $id_builder = $builder_data[0]->builder_id;
                $image = $builder_data[0]->image;
                $tp_kind = $builder_data[0]->tp_kind;
                
                if(!$image)
                    $image = "recipe-no-photo.jpg";
            }
            else
            {
                $id_builder = 0;
                $image = "";
                $tp_kind = 1;
            }


            $tp_kind = 1;#eliminar esta linea si desea que
            #cada grupo de producto tenga sus toppings
            

    		$size_t = DB::table('size')
                ->where('Sz_Item', $id_item)
                ->where('Sz_Status', 0)
                ->get();
           
            
            ###############################
            //$type_category = #CATEGORIA TOPPINGS... REVISAR grtopp
            ###############################
            
            
            $toppings = DB::table('toppings')
                ->where('Tp_Kind', $tp_kind)
                ->where('Tp_Abrev', '!=', '.')
                ->where('Tp_Cat', '>', 0)
                ->select('Tp_Id', 'TP_Descrip', 'Tp_Cat', 'Tp_Double', 'Tp_Topprice')
                ->orderBy('Tp_Cat')
                ->get();

            $def_top = DB::table('topppings_default')
                ->join('toppings', 'toppings.Tp_Id', '=', 'topppings_default.topping_id')
                ->where('topppings_default.product_id', $id_item)
                ->select('toppings.Tp_Descrip')
                ->get();
    	}
    	
    	if( !isset($name) )
    		$name = "Product";
    	if( !isset($size_t) )
    		$size_t = "";
        if(!isset($toppings))
            $toppings = "";
        if(!isset($def_top))
            $def_top = "";


        if($size_t)
        {            
            if($id_builder == 1)
                $vista = 'builder.pizza';
                    
            else if($id_builder == 2)
                $vista = 'builder.salad';
                
            else if($id_builder == 3)
                $vista = 'builder.simple';
        }

        if ( isset($vista) )
        {
            return view($vista)->with([
                    'name'=>$name, 
                    'size'=>$size_t, 
                    'toppings'=>$toppings, 
                    'item'=>$items, 
                    'description'=>$description,
                    'image_category'=>$image,
                    'def_top' => $def_top
                ]);
        }

        return view('builder.generic_builder');
    	   
	}
}
