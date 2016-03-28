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
     * [add_ajax description]
     * @param Request $request [description]
     */
    public function add_ajax(Request $request)
    {
        if( Auth::check() )
        {
            $this->cargar_producto(
                $request['id_size'],
                $request['toppings_id'],
                $request['toppings_size'],
                $request['cooking_notes'],
                $request['quantity']
            );
            
            return response()->json([
                'status'=>'online'
            ]);
        }
        else
        {
            Session::put('size', $request['id_size']);
            Session::put('topping', $request['toppings_id']);
            Session::put('topping_size', $request['toppings_size']);
            Session::put('cooking_instructions', $request['cooking_notes']);
            Session::put('quantity', $request['quantity']);
        
            return response()->json([
                'status'=>'offline'
            ]);
        }     
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
            $quantity = Session::get('quantity');

            //funcion que carga el producto a la db
            $this->cargar_producto(
                $size,
                $toppings,
                $top_size,
                $cooking_instructions,
                $quantity
            );
            
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
     * @param  string $asc [description]
     * @return [type]      [description]
     */
    public static function busq_cart($asc='')
    {
        if($asc==='asc')
        {
            $order_by_cart = 'asc';
        }
        else
        {
           $order_by_cart = 'desc'; 
        }

        $cart = DB::table('cart')
            ->join('size', 'size.Sz_Id', '=','cart.product_id')
            ->join('items', 'items.It_Id', '=', 'size.Sz_Item')
            ->where('cart.id_user', Auth::user()->id)
            ->select(
                'items.It_Descrip',
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
            ->orderBy('cart.id', $order_by_cart)
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
     * @param  boolean $res [description]
     * @return [type]       [description]
     */
    public static function total_price($res=false)
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
    	
        if($res){
            return $total;
        }


    	return response()->json([
        	'total' => $total
        ]);
    }


    /**
     * [cargar_producto description]
     * @param  [type] $size                 [description]
     * @param  [type] $toppings             [description]
     * @param  [type] $top_size             [description]
     * @param  [type] $cooking_instructions [description]
     * @param  [type] $quantity             [description]
     * @return [type]                       [description]
     */
    private function cargar_producto($size, $toppings, $top_size, $cooking_instructions, $quantity)
    {
        $quantity = (int)$quantity;

        if(!$quantity){
            $quantity = 1;
        }

        $id_cart = DB::table('cart')->insertGetId([
            'id_user' => Auth::user()->id,
            'product_id' => $size,
            'cooking_instructions' => $cooking_instructions,
            'quantity' => $quantity
        ]);

        $size_price = DB::table('size')
            ->where('Sz_Id', $size)
            ->select('Sz_Topprice', 'Sz_Topprice2')
            ->first();

        $topping_price = (float)$size_price->Sz_Topprice;
        $topping_price_2 = (float)$size_price->Sz_Topprice2;
       
        if( !is_array($toppings) )
        {
            $toppings = explode(',', $toppings);

            $top_size = explode(',',$top_size);
        }
        

        $array_size = count($toppings);

        for($indice = 0; $indice<$array_size; $indice++)
        {
            $id_top = (int)$toppings[$indice];
            $size_top_id = (int)$top_size[$indice];

            if($id_top)
            {
                $topping = DB::table('toppings')
                    ->where('Tp_Id', $id_top)
                    ->select('Tp_Topprice', 'Tp_Double')
                    ->first();

                $Tp_Topprice =  $topping->Tp_Topprice;
                $Tp_Double =  $topping->Tp_Double;
                $price_top_new = 0;

                if( $Tp_Topprice>0 )
                {
                    $price_top_new = (float)$Tp_Topprice;
                }
                else
                {
                    if($Tp_Double=='N')
                        $price_top_new = (float)$topping_price;
                    else
                        $price_top_new = (float)$topping_price_2;
                }

                if($size_top_id==1 ||  $size_top_id==5)
                {
                    $price_top_new *= 1;
                }
                else if($size_top_id==2 ||  $size_top_id==3)
                {
                    $price_top_new *= 1/2;
                }
                else if($size_top_id==4)
                {
                    $price_top_new *= 2;
                }

                DB::table('cart_top')->insert([
                    'id_cart' => $id_cart,
                    'id_topping' => $id_top,
                    'price' => round($price_top_new, 2),
                    'size' => $size_top_id
                ]);
            }
        }
    }
}
