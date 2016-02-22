<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;

class ProductCTRL extends Controller
{
    public function index($cat, $id)
    {

    	$items = DB::select('SELECT It_Groups, It_Descrip, It_Id, description from items where It_Id = ?', [$id]);
    	
    	if($items)
    	{
    		$name = $items[0]->It_Descrip;
    		$id_item = $items[0]->It_Id;
            $description = $items[0]->description;
            $It_Groups = $items[0]->It_Groups;

    		$size_t = DB::select('SELECT * from size where Sz_Item = ?', [$id_item]);


            $type_categoty = 1;
            $toppings = DB::select('SELECT Tp_Id, TP_Descrip,Tp_Cat from toppings where Tp_Kind = ? and Tp_Abrev!=? and Tp_Cat > 0 order by Tp_Cat', [$type_categoty, '.']);
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


        if($It_Groups==1 or $It_Groups==13){
           return view('builder.product')->with([
            'name'=>$name, 'size'=>$size_t, 'toppings'=>$toppings, 
            'item'=>$items, 'description'=>$description
            ]); 
        }

        return view('builder.generic_builder');
    	   
	}
}
