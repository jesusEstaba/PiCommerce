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
    	$items = DB::select('SELECT * from items where It_Id = ?', [$id]);
    	
    	if($items)
    	{
    		$name = $items[0]->It_Descrip;
    		$id_item = $items[0]->It_Id;

    		$size_t = DB::select('SELECT * from size where Sz_Item = ?', [$id_item]);
    	}
    	

    	//Valores por defecto
    	if( !isset($name) )
    		$name = "Product";
    	if( !isset($size_t) )
    		$size_t = "";


    	return view('product')->with(['name'=>$name, 'size'=>$size_t]);
	}
}
