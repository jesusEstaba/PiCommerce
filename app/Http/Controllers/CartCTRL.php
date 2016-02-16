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
    public function add(Request $request)
    {

    	Session::put('size', $request['id_size']);
    	Session::put('topping', $request['selected']);
    	Session::put('topping_size', $request['sizes']);

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
			$top_size = Session::get('topping_size');

			$id_cart = Cart::create([
				'id_user'=>Auth::user()->id,
				'product_id'=>$size
			])->id;


			$topping_price = DB::select('SELECT Sz_Topprice from size where Sz_Id=?', [$size]);

			$topping_price = $topping_price[0];
			
			$topping_price = (float)$topping_price->Sz_Topprice;

			$toppings = explode(',',$toppings);
			$top_size = explode(',',$top_size);

			$array_size = count($toppings);
			
			for($idx = 0; $idx<$array_size; $idx++)
			{
				$id_top = (int)$toppings[$idx];
				$size_top_id = (int)$top_size[$idx];
				$size_del_top = $size_top_id;


				if($size_top_id==1 or $size_top_id==5)
				{
					$size_top_id = $topping_price;
				}
				elseif ($size_top_id==2 or $size_top_id==3) {
					$size_top_id = round($topping_price * 1/2 , 2);
				}
				elseif($size_top_id==4)
				{
					$size_top_id = $topping_price * 2;
				}
				else
				{
					$size_top_id = $topping_price;
				}
				
				if($id_top)
				{
					DB::table('cart_top')->insert([
						'id_cart'=>$id_cart,
						'id_topping'=>$id_top,
						'price'=>$size_top_id,
						'size'=>$size_del_top
					]);
				}
			}

    		Session::forget('size');
    		Session::forget('toppings');
    		Session::forget('topping_size');
    		
    	}


    	$cart = DB::select('SELECT cart.id, size.Sz_Abrev, size.Sz_Price 
    		from cart 
    		inner join size 
    		on cart.product_id = size.Sz_Id 
    		where cart.id_user = ?
    		order by cart.id desc', [Auth::user()->id]
    	);
    	
    	if( !isset($size) )
    		$size = "";
    	if( !isset($toppings) )
			$toppings = "";

		foreach ($cart as $key => $value) {
			
			$toppings_list = DB::select('SELECT toppings.Tp_Descrip, cart_top.price, cart_top.size
				from cart_top 
				inner join toppings 
				on cart_top.id_topping=toppings.Tp_Id 
				where id_cart = ? order by id_cart', [$value->id]
			);

			$value->{'toppings_list'} = $toppings_list;
		}
    	
    	return view('cart')->with(['cart'=>$cart]);
    }


    	public static function total_price(){
    	
    	$total_cart = DB::select('SELECT sum(cart_top.price) as toppings
    		from cart 
    		
    		inner join cart_top 
    		on cart.id=cart_top.id_cart

    		where cart.id_user=?
			order by cart_top.id_cart
    		',[Auth::user()->id]
    	);

    	if($total_cart)
    	{
    		$total_cart2 = DB::select('SELECT sum(size.Sz_Price) as pizza
	    		from cart 
	    		inner join size
	    		on cart.product_id=size.Sz_Id
	    		where cart.id_user=?
				order by cart.id
	    		',[Auth::user()->id]
    		);

    		if($total_cart2)
    			$total_cart2 = $total_cart2[0]->pizza;
    		else
				$total_cart2 = 0;

    		$total = $total_cart[0]->toppings + $total_cart2;
    	}
    	else
    	{
    		$total = 0.00;
    	}
    	
    	return response()->json([
        	'total' => $total
        ]);
    }
}
