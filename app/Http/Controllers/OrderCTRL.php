<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Mail;


class OrderCTRL extends Controller
{
	/**
	 * [create description]
	 * @return [type] [description]
	 */
    public static function create()
    {
    	
    	$mytime = Carbon::now();
    	$cart = CartCTRL::busq_cart();

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

    		$total = $total_cart[0]->toppings + $total_cart2;
    	}
    	else
    	{
    		$total = 0.00;
    	}
    	//
    	#$total
    	
		$hd_discount = 0;
		$hd_tax = 0;
		$hd_charge = 0;
		$hd_tips = 0;
		$hd_delivery = 0;
    	
    	$total_de_la_Orden = $total + $hd_discount + $hd_tax + $hd_charge + $hd_tips + $hd_delivery;//con los descuentos y vainas

		
		if($total_de_la_Orden)
		{
			$id = DB::table('hd_tticket')->insertGetId([
				'Hd_Sell' => 2,#CAMBIAR// (1=DELIVERY, 2=PICKUP)
				'Hd_Date' => $mytime,
				'Hd_Time' => $mytime,
				'Hd_Customers' => Auth::user()->phone,
				'Hd_User' => 96,#CAMBIAR//REGISTRO NO. 81 DE LA TABLA PASSWORD1
				'Hd_Payform' => 1,#CAMBIAR//RELACION CON LA TABLA PAYFORM (1=CASH, 2=CARD) POR AHORA SOLO 2

				'Hd_Subtotal' => $total,
				
				#'Hd_Discount' => $hd_discount,
				
				#'Hd_Tax' => $hd_tax,//TAX (MULTIPLICACION DEL NET: SUBTOTAL - DISCOUNT) POR EL PORCENTAJE QUE VIENE EN LA TABLA TAXES
				
				#'Hd_Charge' => $hd_charge,//CREDIT CARD PROCESSING FEE EL REGISTRO 2 DE LA TABLA PAYFORM EN EL CAMPO Pf_Charge
				
				#'Hd_Tips' => $hd_tips,//Tips over credit card, after sales
				
				#'Hd_Delivery' => $hd_delivery,DELIVERY CHARGE (LO QUE VENGA EN EL REGISTRO 5 DE LA TABLA PASSWORD1) O LO QUE VENGA EN EL REGISTRO DEL CLIENTE DENTRO DE LA TABLA CUSTOMERS > 0
				
				'Hd_Total' => $total_de_la_Orden,//TOTAL (LA SUMA DE Todos LOS CAMPOS ANTERIORES)
			]);
	    	
	    	
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
	    			#'Dt_SzOrder' => ,//Item Order in the invoice//primary Ky
	    			'Dt_FArea' => $product->Sz_FArea,
	    			'Dt_Qty' => $product->quantity,
	    			'Dt_Price' => $product->Sz_Price,
	    			'Dt_TopPrice' => $product->Sz_Topprice,
	    			'Dt_Total' => ($total_topping->TotalToppings+ $product->Sz_Price)*$product->quantity,
	    			'Dt_TopDescrip' => $product->Sz_Descrip,
	    			'Dt_Detail' => $product->cooking_instructions,
	    		]);

	    		
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
		
		return $errors;
    }
}
