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
        Session::put('cooking_instructions', $request['cooking_instructions']);
        Session::put('quantity', $request['quantity']);
    	
        return Redirect::to('cart');
    }

    
    /**
     * [delete description]
     * @param  Request $id [description]
     * @return [type]      [description]
     */
    public function delete($id)
    {
        DB::table('cart_top')
            ->where('id_cart', $id)
            ->delete();
    	
        $delete_res = DB::table('cart')
            ->where('id_user', Auth::user()->id)
            ->where('id', $id)
            ->delete();

    	return response()->json([
        	'state' => $delete_res,
        ]);
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
            $cooking_instructions = Session::get('cooking_instructions');
            $quantity = (int)Session::get('quantity');

            if(!$quantity)
                $quantity = 1;

            $id_cart = DB::table('cart')
                ->insertGetId([
				    'id_user' => Auth::user()->id,
				    'product_id' => $size,
                    'cooking_instructions' => $cooking_instructions,
                    'quantity' => $quantity
                ]);

			$topping_price = DB::table('size')
                ->where('Sz_Id', $size)
                ->select('Sz_Topprice')
                ->get();

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
					$size_top_id = $topping_price;
				
				elseif ($size_top_id==2 or $size_top_id==3)
					$size_top_id = round($topping_price * 1/2 , 2);

				elseif($size_top_id==4)
					$size_top_id = $topping_price * 2;
				

				else
					$size_top_id = $topping_price;
				
				if($id_top)
				{
					DB::table('cart_top')->insert([
						'id_cart' => $id_cart,
						'id_topping' => $id_top,
						'price' => $size_top_id,
						'size' => $size_del_top
					]);
				}
			}
            Session::forget('size');
            Session::forget('toppings');
            Session::forget('topping_size');
            Session::forget('cooking_instructions');
            Session::forget('quantity');
    		
    	}

    	$cart = CartCTRL::busq_cart();

        if( !isset($size) )
            $size = "";
        if( !isset($toppings) )
            $toppings = "";

    	return view('cart')->with(['cart'=>$cart]);
    }


    /**
     * [busq_cart description]
     * @return [type] [description]
     */
    public static function busq_cart()
    {
        $cart = DB::table('cart')
            ->join('size', 'size.Sz_Id', '=','cart.product_id')
            ->where('cart.id_user', Auth::user()->id)
            ->select(
                'cart.id',
                'cart.product_id', 
                'cart.quantity', 
                'cart.id', 
                'cart.cooking_instructions', 
                'size.Sz_Abrev', 
                'size.Sz_FArea', 
                'size.Sz_Price', 
                'size.Sz_Topprice', 
                'size.Sz_FArea',
                'size.Sz_Descrip'
                )
            ->orderBy('cart.id', 'desc')
            ->get();

        foreach ($cart as $key => $value)
        {

            $toppings_list = DB::table('cart_top')
                ->join('toppings', 'toppings.Tp_Id', '=', 'cart_top.id_topping')
                ->where('id_cart', $value->id)
                ->orderBy('id_cart')
                ->select('toppings.Tp_Id', 'toppings.Tp_Descrip', 'cart_top.price', 'cart_top.size')
                ->get();

            $value->{'toppings_list'} = $toppings_list;
        }

        return $cart;
    }


    /**
     * [total_price description]
     * @return [type] [description]
     */
    public static function total_price()
    {
        $total_cart = DB::table('cart')
            ->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
            ->where('cart.id_user', Auth::user()->id)
            ->selectRaw('sum(cart_top.price*cart.quantity) as toppings')
            ->orderBy('cart_top.id_cart')
            ->get();

    	if($total_cart)
    	{
            $total_cart2 = DB::table('cart')
                ->join('size', 'size.Sz_Id', '=', 'cart.product_id')
                ->where('cart.id_user', Auth::user()->id)
                ->selectRaw('sum(size.Sz_Price*cart.quantity) as pizza')
                ->orderBy('cart.id')
                ->get();

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
