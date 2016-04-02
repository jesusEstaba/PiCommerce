<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Mail;
use Session;
use Input;

class OrderCTRL extends Controller
{
	/**
	 * [create description]
	 * @return [type] [description]
	 */
    public static function create()
    {

    	$hd_charge = 0;
		$hd_tips = 0;
		$hd_delivery = 0;
		$hd_payform = 1;

		if( Input::get('card') ){
			
			$fee = DB::table('payform')->select('Pf_Charge')->where('Pf_Id', 2)->first();

			$hd_charge = (float)$fee->Pf_Charge;
			$hd_payform = 2;
		}

		if( Input::get('delivery') ){
			$hd_delivery = Input::get('delivery');
		}

		if( Input::get('tips') ){
			$hd_tips = Input::get('tips');
		}


    	/*
    	DEBERIA CARGAR ESTO POR AJAX
    	 
    	$hd_charge
		$hd_tips
		$hd_delivery
		*/

    	$mytime = Carbon::now();
    	
    	$cart = CartCTRL::busq_cart();//sesion en vez de llamar al controller

    	//Calculando total del carrito

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

    		$sub_total = $total_cart[0]->toppings + $total_cart2;
    	}
    	else
    	{
    		$sub_total = 0.00;
    	}
    	
    	#$total// es el sub total
		$hd_discount = 0;
		

		if( Session::has('coupon_discount') )
		{
			$coupon_disc = (float) Session::get('coupon_discount');

			$hd_discount = $sub_total * $coupon_disc / 100;

			Session::forget('coupon_discount');
		}
		else
		{
			$coupon_disc = 0;
		}



		$tax = DB::table('taxes')->first();
		$tax = (float)$tax->Tx_Base;
		
		$hd_tax = ($sub_total-$hd_discount) * $tax/100;
		$hd_tax = round($hd_tax, 2);

		
    	
    	$total_de_la_Orden = ($sub_total - $hd_discount) + $hd_tax + $hd_charge + $hd_tips + $hd_delivery;

		
		if($total_de_la_Orden)
		{
			$id = DB::table('hd_tticket')->insertGetId([
				'Hd_Sell' => 2,#CAMBIAR// (1=DELIVERY, 2=PICKUP)
				'Hd_Date' => $mytime,
				'Hd_Time' => $mytime,
				'Hd_Customers' => Auth::user()->phone,
				'Hd_User' => 96,#CAMBIAR//REGISTRO NO. 81 DE LA TABLA PASSWORD1
				'Hd_Payform' => $hd_payform,#CAMBIAR//RELACION CON LA TABLA PAYFORM (1=CASH, 2=CARD) POR AHORA SOLO 2
				'Hd_Subtotal' => $sub_total,
				'Hd_Discount' => round($hd_discount, 2),
				'Hd_Tax' => $hd_tax,
				'Hd_Charge' => $hd_charge,//CREDIT CARD PROCESSING FEE
				'Hd_Tips' => $hd_tips,//Tips over credit card, after sales
				'Hd_Delivery' => $hd_delivery,//DELIVERY CHARGE
				'Hd_Total' => round($total_de_la_Orden, 2),//TOTAL (LA SUMA DE Todos LOS CAMPOS ANTERIORES)
			]);

			if( Session::has('coupon_id') )
			{

				CouponsCTRL::use_coupon($id, Session::get('coupon_id'));
				Session::forget('coupon_id');
			}
	    	
	    	
	    	foreach ($cart as $c_key => $product)
	    	{
	    		$total_topping = DB::table('cart')
	    			->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
	    			->where('cart_top.id_cart', $product->id)
	    			->selectRaw('sum(cart_top.price) AS TotalToppings')
	    			->get();

	    		if($total_topping)
	    			$total_topping = $total_topping[0];
	    		else
	    			$total_topping = 0;


	    		$id_cart = DB::table('dt_tticket')->insertGetId([
	    			'Dt_Ticket' => $id,
	    			'Dt_Size' => $product->product_id,
	    			'Dt_FArea' => $product->Sz_FArea,
	    			'Dt_Qty' => $product->quantity,
	    			'Dt_Price' => $product->Sz_Price,
	    			'Dt_TopPrice' => $product->Sz_Topprice,
	    			'Dt_Total' => ($total_topping->TotalToppings+ $product->Sz_Price)*$product->quantity,
	    			'Dt_TopDescrip' => $product->Sz_Descrip,
	    			'Dt_Detail' => $product->cooking_instructions,
	    		]);
				
				DB::table('dt_tticket')
					->where('Dt_Ticket', $id)
					->update([
						'Dt_SzOrder' => $id_cart,//Item Order in the invoice//primary Ky
					]);

	    		$id_order_size = $id_cart;
	    		
	    		foreach ($product->toppings_list as $key => $topping)
	    		{		

	    			DB::table('dt_topping')->insert([
	    				'DTt_SzId' => $id_cart,
	    				'DTt_Ticket' => $id,
	    				'DTt_Size' => $product->product_id,
	    				#'DTt_SzOrder' => ,//Item Order in the invoice//for Ky
	    				'DTt_Topping' => $topping->Tp_Id,
	    				'DTt_Detail' => $topping->Tp_Descrip,
	    				'DTt_Topprice' => $topping->price,
	    				#'DTt_TopOrder' => ,//Topping Order under the Item (Dt_Size)
	    			]);

	    		}
	    		
	    	}

			//VACIAR CARRITO
			//enviar correos
			//
			//
			foreach ($cart as $key => $value) {
				
				DB::table('cart_top')
					->where('id_cart', $value->id)
					->delete();

				DB::table('cart')
					->where('id', $value->id)
					->delete();
			}

			LogsCTRL::add_to_log('Order');

			/*
			$variables_correo = ['me_le_ponen'=>'gas del bueno'];

			Mail::send('template_mail.prueba', $variables_correo, function($msj)
			{
            	$msj->subject('Order');
            	$msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            	$msj->to('jeec.estaba@gmail.com');
            });
            
            if(count(Mail::failures()))
            {
            	$errors = 'Failed to send password reset email, please try again.';
            }
			*/
		}

    	if( !isset($errors) )
    		$errors = "todo correcto <a href='cart'>Cart</a>";
		
		return response()->json(['status'=>'correct']);
    }


}
