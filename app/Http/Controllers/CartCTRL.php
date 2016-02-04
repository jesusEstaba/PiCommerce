<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Session;
use Redirect;
use Auth;
use DB;

class CartCTRL extends Controller
{
	/**
	 * [add description]
	 * @param Request $request [description]
	 */
    public function add(Request $request){
    	/*
    	echo 'request:<br>';
    	echo $request['selected'].'<br>';
    	echo $request['id_size'].'<br>';
		*/
    	
    	//$toppings = explode(',',  $request['selected']);
   
    	//print_r($toppings);


    	#Session::flush();//usar para no acumualar la peticiones

    	Session::put('size', $request['id_size']);
    	Session::push('topping', $request['selected']);

    	return Redirect::to('cart');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    	

    	if( Session::has('size') ){
    		//agregar a la DB{
    			$size = Session::get('size');
    			$toppings = Session::get('topping');

    			DB::table('cart')->insert([
    				'id_user'=>Auth::user()->id,
    				'product_id'=>$size
    			]);
    		//}
    		

    		Session::forget('size');
    		Session::forget('toppings');
    		//usar para no acumualar la peticiones
    	}

    	$cart = DB::select('SELECT size.Sz_Abrev, size.Sz_Price from cart inner join size on cart.product_id = size.Sz_Id where cart.id_user = ?', [Auth::user()->id]);
    	
    	if( !isset($size) )
    		$size = "";
    	if( !isset($toppings) )
			$toppings = "";

    	return view('cart')->with(['cart'=>$cart]);
    }
}
