<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Session;
use Redirect;
use Auth;
use DB;
use Pizza\Cart;


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
    	Session::put('topping', $request['selected']);

    	return Redirect::to('cart');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    	

    	if( Session::has('size') )
    	{
			$size = Session::get('size');
			$toppings = Session::get('topping');
			
			$id_cart = Cart::create([
				'id_user'=>Auth::user()->id,
				'product_id'=>$size
			])->id;
			
			$toppings = explode(',',$toppings);

			foreach ($toppings as $key => $value)
			{
				$value = (int) $value;
				if($value)
				{
					DB::table('cart_top')->insert([
						'id_cart'=>$id_cart,
						'id_topping'=>$value
					]);
				} 
			}

    		Session::forget('size');
    		Session::forget('toppings');
    	}

    	$cart = DB::select('SELECT cart.id, size.Sz_Abrev, size.Sz_Price 
    		from cart 
    		inner join size 
    		on cart.product_id = size.Sz_Id 
    		where cart.id_user = ?', [Auth::user()->id]
    	);
    	
    	if( !isset($size) )
    		$size = "";
    	if( !isset($toppings) )
			$toppings = "";

		foreach ($cart as $key => $value) {
			
			$toppings_list = DB::select('SELECT toppings.Tp_Descrip 
				from cart_top 
				inner join toppings 
				on cart_top.id_topping=toppings.Tp_Id 
				where id_cart = ?', [$value->id]
			);

			$value->{'toppings_list'} = $toppings_list;
		}
    	
    	//return $cart;
    	return view('cart')->with(['cart'=>$cart]);
    }
}
