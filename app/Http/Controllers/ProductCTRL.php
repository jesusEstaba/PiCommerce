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
    public function index($cat, $id, $sub="")
    {	
        if($sub=="sub")
        {
            $size_t = DB::table('size')
                ->join('items', 'items.It_Id', '=', 'size.Sz_Item')
                ->where('size.Sz_Id', $id)
                ->first();


            $builder_data = DB::table('category')
                ->where('group_id', $size_t->It_Groups)
                ->where('Status', 0)
                ->select('builder_id', 'image')
                ->first();


            if($builder_data)
            {
                $id_builder = $builder_data->builder_id;
                $image = $builder_data->image;
                
                if(!$image)
                    $image = "recipe-no-photo.jpg";
            }
            else
            {
                $id_builder = 0;
                $image = "";
            }


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
                    'name'=>$size_t->Sz_Descrip, 
                    'size'=>$size_t, 
                    'toppings'=>"", 
                    'item'=>true, 
                    'description'=>"",
                    'image_category'=>$image,
                ]);
            }

            return view('builder.generic_builder');
        }

        $items = DB::table('items')
            ->where('It_Id', $id)
            ->where('It_Status', 0)
            ->select('items.It_Groups', 'items.It_Descrip', 'items.It_Id', 'items.description')
            ->first();


    	if($items)
    	{
    		$name = $items->It_Descrip;
    		$id_item = $items->It_Id;
            $description = $items->description;
            $It_Groups = $items->It_Groups;

            $builder_data = DB::table('category')
                ->where('group_id', $It_Groups)
                ->where('Status', 0)
                ->select('builder_id', 'image', 'tp_kind')
                ->first();
            
            if($builder_data)
            {
                $id_builder = $builder_data->builder_id;
                $image = $builder_data->image;
                $tp_kind = $builder_data->tp_kind;
                
                if(!$image)
                    $image = "recipe-no-photo.jpg";
            }
            else
            {
                $id_builder = 0;
                $image = "";
                $tp_kind = 1;
            }


            //$tp_kind = 1;#eliminar esta linea si desea que
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
                ->where('Tp_Cat', '!=', 0)
                ->select('Tp_Id', 'TP_Descrip', 'Tp_Cat', 'Tp_Double', 'Tp_Topprice')
                ->orderBy('Tp_Cat')
                ->get();

            
    	}
    	
    	if( !isset($name) )
    		$name = "Product";
    	if( !isset($size_t) )
    		$size_t = "";
        if(!isset($toppings))
            $toppings = "";

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
                    'tp_kind'=>$tp_kind
                ]);
        }

        return view('builder.generic_builder');
    	   
	}
}
