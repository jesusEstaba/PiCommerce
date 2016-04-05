<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Input;
use Mail;
use Session;
use Carbon\Carbon;

class QuickPayCTRL extends Controller
{
    public function index(){
    	 $config = DB::table('config')->first();
        return view('checkout.quick')->with(['config'=>$config]);
    }

    public function createOrderQuick(){
    	$id_order_for_temp_user = 0;
    	$day_now = Carbon::now()->format('d-m-Y');
    	
    	
    	if( Session::has('size') && Input::has('first_name') && Input::has('phone') && Input::has('email') )
    	{
			$size = Session::get('size');
			$toppings = Session::get('topping');
			$top_size = Session::get('topping_size');
            $cooking_instructions = Session::get('cooking_instructions');
            $quantity = Session::get('quantity');

            //funcion que carga el producto a la db
            $id_cart_go = CartCTRL::cargar_producto(
                $size,
                $toppings,
                $top_size,
                $cooking_instructions,
                $quantity,
                true
            );
            
            Session::forget('size');
            Session::forget('toppings');
            Session::forget('topping_size');
            Session::forget('cooking_instructions');
            Session::forget('quantity');
    		
            $hd_sell = 2;#PICKUP//poner un mensaje en caso de que estaba en delivery y no se pudo
	    	$hd_charge = 0;
			$hd_tips = 0;
			$hd_delivery = 0;
			$hd_payform = 1;
			$or_delivery = false;
			$or_discount = false;
			$or_charge = false;
			$or_tip = false;

	    	$mytime = Carbon::now();
	    	
	    	if($id_cart_go)
	    	{
	    		$cart = CartCTRL::busq_cart('asc', $id_cart_go);//se deberia Cargar desde la sesion en vez de llamar al controller

		    	//Calculando total del carrito
		    	$total_cart = DB::table('cart')
		    		->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
		    		->where('cart.id_user', 314)
		    		->where('cart.id', $id_cart_go)
		    		->selectRaw('sum(cart_top.price*cart.quantity) as toppings')
		    		->orderBy('cart_top.id_cart')
		    		->first();

		    	if($total_cart)
		    	{
		    		$total_cart2 = DB::table('cart')
		    			->join('size', 'size.Sz_Id', '=', 'cart.product_id')
		    			->where('cart.id_user', 314)
		    			->where('cart.id', $id_cart_go)
		    			->selectRaw('sum(size.Sz_Price*cart.quantity) as pizza')
		    			->orderBy('cart.id')
		    			->first();

		    		if($total_cart2){
		    			$total_cart2 = $total_cart2->pizza;
		    		}
		    		else{
						$total_cart2 = 0;
		    		}

		    		$sub_total = $total_cart->toppings + $total_cart2;
		    	}
		    	else
		    	{
		    		$sub_total = 0.00;
		    	}
		    	
				$hd_discount = 0;

				if( Session::has('coupon_discount') )
				{
					$coupon_disc = (float) Session::get('coupon_discount');
					$hd_discount = $sub_total * $coupon_disc / 100;

					Session::forget('coupon_discount');
					$or_discount = true;
				}
				else
				{
					$coupon_disc = 0;
				}

				$tax = DB::table('taxes')->first();
				$tax = (float)$tax->Tx_Base;
				$hd_tax = ($sub_total-$hd_discount) * $tax / 100;
				$hd_tax = round($hd_tax, 2);
		    	
		    	$total_de_la_Orden = ($sub_total - $hd_discount) + $hd_tax + $hd_charge + $hd_tips + $hd_delivery;

				if($total_de_la_Orden)
				{
					$id = DB::table('hd_tticket')->insertGetId([
						'Hd_Sell' => $hd_sell,
						'Hd_Date' => $mytime,
						'Hd_Time' => $mytime,
						'Hd_Customers' => 314,
						'Hd_User' => 96,#CAMBIAR//REGISTRO NO. 81 DE LA TABLA PASSWORD1
						'Hd_Payform' => $hd_payform,
						'Hd_Subtotal' => $sub_total,
						'Hd_Discount' => round($hd_discount, 2),
						'Hd_Tax' => $hd_tax,
						'Hd_Charge' => $hd_charge,
						'Hd_Tips' => $hd_tips,//Tips over credit card, after sales
						'Hd_Delivery' => $hd_delivery,
						'Hd_Total' => round($total_de_la_Orden, 2),
					]);

					$id_order_for_temp_user = $id;

					if( Session::has('coupon_id') )
					{
						CouponsCTRL::use_coupon($id, Session::get('coupon_id'));
						Session::forget('coupon_id');
					}
			    	
			    	$cont_order = 1;

			    	foreach ($cart as $c_key => $product)
			    	{
			    		$total_topping = DB::table('cart')
			    			->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
			    			->where('cart_top.id_cart', $product->id)
			    			->selectRaw('sum(cart_top.price) AS TotalToppings')
			    			->get();

			    		if($total_topping){
			    			$total_topping = $total_topping[0];
			    		}
			    		else{
			    			$total_topping = 0;
			    		}

			    		$dt_total = ($total_topping->TotalToppings+ $product->Sz_Price)*$product->quantity;

			    		$id_cart = DB::table('dt_tticket')->insertGetId([
			    			'Dt_Ticket' => $id,
			    			'Dt_Size' => $product->product_id,
			    			'Dt_SzOrder' => $cont_order,//Order
			    			'Dt_FArea' => $product->Sz_FArea,
			    			'Dt_Qty' => $product->quantity,
			    			'Dt_Price' => $product->Sz_Price,
			    			'Dt_TopPrice' => $product->Sz_Topprice,
			    			'Dt_Total' => $dt_total,
			    			
			    			//'Dt_TopDescrip' => $product->Sz_Descrip,
			    			'Dt_Detail' => $product->cooking_instructions,
			    			'Dt_Detail1' => $product->Sz_Descrip,
			    			'Dt_Detail2' => $product->Sz_Descrip,
			    		]);
			    		
			    		foreach ($product->toppings_list as $key => $topping)
			    		{		
			    			DB::table('dt_topping')->insert([
			    				'DTt_SzId' => $cont_order,//Order
			    				'DTt_Ticket' => $id,
			    				'DTt_Size' => $product->product_id,
			    				'DTt_Topping' => $topping->Tp_Id,
			    				'DTt_Detail' => $topping->Tp_Descrip,
			    				'DTt_Topprice' => $topping->price,
			    				#'DTt_SzOrder' => ,//Item Order in the invoice
			    				#'DTt_TopOrder' => ,//Topping Order under the Item (Dt_Size)
			    			]);
			    		}

			    		++$cont_order;
			    	}

					//VACIAR CARRITO
					foreach ($cart as $key => $value) {
						
						DB::table('cart_top')
							->where('id_cart', $value->id)
							->delete();

						DB::table('cart')
							->where('id', $value->id)
							->delete();
					}

					//AÑADIENDO LOG DE LA IP
					LogCTRL::addToLog(314);
					

					//ENVIAR CORREOS
					$correos = DB::table('emails_admin')->get();
					

					$mail_user = Input::get('email');
					

					$config = DB::table('config')->first();

					$order = DB::table('hd_tticket')->where('Hd_Ticket', $id)->first();
			        
					$size =function ($size)
				    {
				        if($size==1)
				            $size_topping = '(All)';
				        elseif($size==2)
				            $size_topping = '(Left)';
				        elseif($size==3)
				            $size_topping = '(Rigth)';
				        elseif($size==4)
				            $size_topping = '(Extra)';
				        elseif($size==5)
				            $size_topping = '(Lite)';
				        
				        return $size_topping;
				    };


			    	

			        $variables_correo = [
				        'order' => $order,
				        'now' => $day_now,

				        'delivery'=>false,
				        'discount' => $or_discount,
				        'charge' => $or_charge,
				        'tip'=>$or_tip,

				        'cart'=>$cart,
				        'title'=>'Quick Order',
				        'size'=>$size,//FUNCTION()
				        'logo' => $config->logo,
				        'footer'=> $config->footer,
				        'num_order'=>$id_order_for_temp_user,
				        

				        'phone' => Input::get('phone'),
				        'name'=> Input::get('first_name').' '.Input::get('last_name'),
				        'email'=>Input::get('email'),

				        'street_num' => '',
				        'street_name' => '',
				        'zip_code' => '',
			        ];
			        
			        //$cart
			        //
			        Mail::send('mail_template.order', $variables_correo, function($msj) use ($mail_user)
			        {
			            $msj->subject('Quick Order');
			            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
			            
			            $msj->to($mail_user);    
			        });
			        
			        Mail::send('mail_template.order', $variables_correo, function($msj) use ($correos)
			        {
			            $msj->subject('Quick Order');
			            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));

			            foreach($correos as $array => $admin)
			            {
			                $msj->to($admin->email);
			            }
			        });

			        if( $error_num_mail = count( Mail::failures() ) )
			        {
			            $errors = 'Failed to send email';
			        }
				}
	    	}
	    	else
	    	{
	    		$errors = 'Could not load the temporary product';
	    	}
	    	
		}
		else
		{
			$errors = 'You have not loaded a product';
		}


		if( !isset($errors) && $id_order_for_temp_user)
		{		            
			$errors = ['status'=>'correct'];
			
			DB::table('temp_user_order')->insert([
				'first_name' => Input::get('first_name'),
				'last_name' => Input::get('last_name'),
				'phone' => Input::get('phone'),
				'email' => Input::get('email'),
				'order_id' => $id_order_for_temp_user,
				'created_at' => Carbon::now()
			]);
		}
		if($id_order_for_temp_user==0)
		{
			$errors = "Soory, We could not process your order";
		}


		return response()->json($errors);
    }
}
