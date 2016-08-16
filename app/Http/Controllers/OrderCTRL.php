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
     * @author Jesus estaba <jeec.estaba@gmail.com>
     *
     */


    /**
     * [primera etapa]
     * Creardo Orden
     *
     * -se calcula el precio total de los productos del carrito
     *      --se cargan los cupones
     *      --se calculan los impuestos, descuentos y propinas
     * -se crean los registro de facturacion
     */
    public static function create()
    {
        $hd_sell = 2;#PICKUP//poner un mensaje en caso de que estaba en delivery y no se pudo
        $hd_charge = 0;
        $hd_tips = 0;
        $hd_delivery = 0;
        $payform = 1;
        $or_delivery = false;
        $or_discount = false;
        $or_charge = false;
        $or_tip = false;

        if (Input::get('card')==='true') {
            $fee = DB::table('payform')
                ->select('Pf_Charge')
                ->where('Pf_Id', 2)
                ->first();

            $hd_charge = (float)$fee->Pf_Charge;
            $payform = 2;

            $or_charge = true;
        }

        if (Input::get('delivery')==='true') {
            
            $deliveryValue = DB::table('password1')
                ->select('G_Value')
                ->where('G_Id', 5)
                ->first();
            
            $delivery_val = ($deliveryValue) ? $deliveryValue->G_Value : 0;

            $hd_sell = 1;
            $hd_delivery = (float)$delivery_val->G_Value;
            $or_delivery = true;
        }

        if (Input::get('tips')==='true') {
            $tip = (float)Input::get('tip');
            $tip = round($tip, 2);
            $hd_tips = $tip;
            $or_tip = true;
        }

        $mytime = Carbon::now();


        if (Auth::check()) {
            $cart = Session::get('cart');//cargar  de uns sesion
            //Calculando total del carrito
            $sub_total = CartCTRL::totalCostCart(true);

            $hdOrderUser = Auth::user()->phone;
        } else {
            $idCartSession = (int)Session::get('id_cart');
            $cart = CartCTRL::searchCartItems('combo', $idCartSession);
            //Calculando total del carrito
            $sub_total = CartCTRL::totalCostCart(true, $idCartSession);

            $hdOrderUser = 314;
        }

        $hd_discount = 0;

        if (Session::has('coupon_discount')) {
            $coupon_disc = (float) Session::get('coupon_discount');
            $coupon_type = (int) Session::get('coupon_type');

            if ($coupon_type===1) {
                $hd_discount = $sub_total * $coupon_disc / 100;
            } else {
                $hd_discount = $coupon_disc;
            }

            Session::forget('coupon_discount');
            Session::forget('coupon_type');
            $or_discount = true;
        } else {
            $coupon_disc = 0;
        }

        $subtotal_discount = $sub_total-$hd_discount;

        if ($subtotal_discount<0) {
            $subtotal_discount = 0;
        }

        $tax = DB::table('taxes')->first();
        $tax = (float)$tax->Tx_Base;
        $hd_tax = $subtotal_discount * $tax/100;
        $hd_tax = round($hd_tax, 2);

        $total_de_la_Orden = $subtotal_discount + $hd_tax + $hd_charge + $hd_tips + $hd_delivery;

        $minOrderValue = DB::table('password1')
            ->select('G_Value')
            ->where('G_Description', 'Minimun_order')
            ->first();
        
        $minValue = ($minOrderValue) ? $minOrderValue->G_Value : 0;

        if ($minValue) {
            $minValue = $minValue->G_Value;
        } else {
            $minValue = 0;
        }

        if ($sub_total >= $minValue) {
            $id = static::createOrder(
                $cart,
                [
                    'Hd_Sell' => $hd_sell,
                    'Hd_Date' => $mytime,
                    'Hd_Time' => $mytime,
                    'Hd_Customers' => $hdOrderUser,
                    
                    'Hd_User' => 96,#CAMBIAR//REGISTRO NO. 81 DE LA TABLA PASSWORD1//cambiarlo por el nombre del campo para "parametrizarlo"
                    
                    'Hd_Payform' => $payform,
                    'Hd_Subtotal' => $sub_total,
                    'Hd_Discount' => round($hd_discount, 2),
                    'Hd_Tax' => $hd_tax,
                    'Hd_Charge' => $hd_charge,
                    'Hd_Tips' => $hd_tips,//Tips over credit card, after sales
                    'Hd_Delivery' => $hd_delivery,
                    'Hd_Total' => round($total_de_la_Orden, 2),
                    'Hd_Status' => 0,
                    'Hd_Observac' => 0,
                    'Hd_Observac1' => 0,
                    'Hd_StatusTip' => 0,
                ]
            );

            if (Session::has('coupon_id')) {
                CouponsCTRL::useDiscountCoupon($id, Session::get('coupon_id'));
                Session::forget('coupon_id');
            }
            

            if (Auth::check()) {
                $phonePurchase = Auth::user()->phone;
                $memoPerchase = 'Sale Web';
            } else {
                $phonePurchase = Session::get('phone');
                $memoPerchase = 'Quick Sale';
            }

            if ($payform == 2) { //credito
                $mercuryResponse = static::createPayment([
                    'Invoice' => $id,
                    'TotalAmount' =>  round($total_de_la_Orden, 2),
                    'CustomerCode' => $phonePurchase,
                    'Memo' => $memoPerchase,
                ],
                $hd_sell);



                if ($mercuryResponse['code']!=0) {
                    $errors = $mercuryResponse['message'];
                } else {

                    DB::table('hd_tticket')
                        ->where('Hd_Ticket', $id)
                        ->update([
                            'Hd_PaymentId' => $mercuryResponse['PayId'],
                        ]);

                    $errors = [
                        'status'=> 1,
                        'message' => $mercuryResponse['PayId'],
                        'url' => $mercuryResponse['urlCheckout'],
                    ];
                }
            } else {//efectivo
                
                CartCTRL::clear($cart);

                $errors = [
                    'status'=> 2,
                    'message' => 'cash',
                ];

                //ENVIAR CORREOS
                if (static::sendMailOrder($id, $cart)) {
                    $errors = 'Failed to send email.';
                }
            }

            

            
        } else {
            $errors = 'No is Min Order';
        }

        if (!isset($errors)) {
            $errors = [
                'status'=> 0,
                'message' => 'correct',
            ];
        }

        return response()->json($errors);
    }


    /**
     * Se Inicia un proceso de pago en Mercury
     *
     * @return array [Response de Mercury]
     */
    protected static function createPayment(array $paramsData, $numChck)
    {
        $soapHelper = new PayMercuryCtrl();
        $checkouts = [1 => 'delivery', 2 => 'pickup'];

        $dataPayment = [
            'TaxAmount' => 0.0,
            'TranType' => 'Sale',
            'Frequency' => 'OneTime',
            'ProcessCompleteUrl' => url('/checkout/verify'),
            'ReturnUrl' => url('/checkout/' . $checkouts[$numChck]),//esto va a depender de donde esta
        ];

        $dataPayment = array_merge($dataPayment, $paramsData);
        
        $initPaymentResponse = $soapHelper->InitializePayment($dataPayment);
        
        return [
            'code' => $initPaymentResponse->ResponseCode,
            'message' => $initPaymentResponse->Message,
            'PayId' => $initPaymentResponse->PaymentID,
            'urlCheckout' => $soapHelper->urlCheckout(),
        ];
    }


    /**
     * [segunda etapa]
     * Verificando Pago
     * 
     * -se revisa el codigo del error, se devolvera un mensaje indicando
     * el error. en caso de ser 0:
     *      --se cambia el status en el registro de facturacion y se agregan los datos
     *      de respuesta de mercury
     *      --se vacia el carrito
     *      --se envian los correos pertinentes
     *
     */
    public static function verify(Request $request)
    {
        //checkear las facturas con status '0'

        $soapHelper = new PayMercuryCtrl();

        $dataVerify = [
            'PaymentID' => $request['PaymentID'],
        ];
        
        $mercuryResp = $soapHelper->VerifyPayment($dataVerify);
        
        if ($mercuryResp->ResponseCode==0  
            && Session::has('cart')
            #&& $mercuryResp->Status == 'Approved'
        ) {
            $cart = Session::get('cart');
            Session::forget('cart');
            
            //VACIAR CARRITO
            CartCTRL::clear($cart);
            
            
            DB::table('hd_tticket')->where('Hd_Ticket', $mercuryResp->Invoice)->update([
                'Hd_Status' => 1,

                'Hd_MStatus' => $mercuryResp->Status,
                'Hd_MToken' => $mercuryResp->Token,
                'Hd_MRefNumber' => $mercuryResp->RefNo,
                'Hd_MAuthCode' => $mercuryResp->AuthCode,
                'Hd_MAcqRefData' => $mercuryResp->AcqRefData,
                'Hd_MProcessData' => $mercuryResp->ProcessData,
                'Hd_MCard' => $mercuryResp->MaskedAccount,
                'Hd_MCardHolderName' => $mercuryResp->CardholderName,
                #'Hd_StatusTip' => '',
                #'Hd_MDigits' => '',

            ]);

            //ENVIAR CORREOS
            if (static::sendMailOrder($mercuryResp->RefNo, $cart)) {
                $errors = 'Failed to send email.';
            }

        }
        
        

        

        
        
        return response()->json([
            'code' => $mercuryResp->ResponseCode,
            'status' => $mercuryResp->Status,
            'message' => $mercuryResp->StatusMessage,
        ]);
    }


    /**
     * Crea los registros en las tablas de facturacion
     * se añaden las cabezeras de la factura, los productos y sus modificaiones
     */
    protected static function createOrder(array $cart, array $dataHdTicket)
    {
        $id = DB::table('hd_tticket')->insertGetId($dataHdTicket);

        $listCombosId = [];

        foreach ($cart as $c_key => $product) {
            $cont_order = 1;

            $total_topping = DB::table('cart')
                ->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
                ->where('cart_top.id_cart', $product->id)
                ->selectRaw('sum(cart_top.price) AS TotalToppings')
                ->get();

            if ($total_topping) {
                $total_topping = $total_topping[0];
            } else {
                $total_topping = 0;
            }

            $dt_total = ($total_topping->TotalToppings + $product->Sz_Price) * $product->quantity;       

            $dataTicktet = [
                'Dt_Ticket' => $id,
                'Dt_Size' => $product->product_id,
                'Dt_SzOrder' => $cont_order,//Order
                'Dt_FArea' => $product->Sz_FArea,
                'Dt_Qty' => $product->quantity,
                'Dt_Price' => $product->Sz_Price,
                'Dt_TopPrice' => $product->Sz_Topprice,
                'Dt_Total' => $dt_total,
                #'Dt_TopDescrip' => $product->Sz_Descrip,
                'Dt_Detail' => $product->cooking_instructions,
                'Dt_Detail1' => $product->Sz_Descrip,
                'Dt_Detail2' => $product->Sz_Descrip,
            ];

            if($product->is_combo==1) {//cuando es un combo
                $dataTicktet['Dt_Detail4'] = 'Combo';
            } else {
                if($product->combo!=0 && isset($listCombosId[$product->combo])) {
                    $dataTicktet['Dt_Detail4'] = $listCombosId[$product->combo];
                }
            }

            $id_cart = DB::table('dt_tticket')->insertGetId($dataTicktet);

            if($product->is_combo==1) {//cuando es un combo
                $listCombosId[$product->id] = $id_cart;
            }

            foreach ($product->toppings_list as $key => $topping) {
                DB::table('dt_topping')->insert([
                    'DTt_SzId' => $cont_order,//Order
                    'DTt_Ticket' => $id,
                    'DTt_Size' => $product->product_id,
                    'DTt_Topping' => $topping->Tp_Id,
                    'DTt_Detail' => $topping->Tp_Descrip,
                    'DTt_Topprice' => $topping->price,
                    #'DTt_SzOrder' => '',//Item Order in the invoice
                    #'DTt_TopOrder' => '',//Topping Order under the Item (Dt_Size)
                ]);
            }

            ++$cont_order;
        }

        return $id;
    }


    /**
     * revisar las dependencia con las variables exteriores
     * lo mejor seria volver a cagar los productos desde acá
     * 
     * abra que hacer unas modificaciones y empezar a llamar desde la tabla de facturacion
     *
     * @return [numero de correos no enviados]
     */
    protected static function sendMailOrder($orderId, $cart)
    {
        if (Auth::check()) {
            LogCTRL::addToLog(5);//AÑADIENDO LOG DE LA IP
            
            $user = DB::table('users')
                ->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
                ->where('users.phone', Auth::user()->phone)
                ->select(
                    'Cs_Number',
                    'Cs_Street',
                    'Cs_ZipCode',
                    'Cs_Notes',
                    'Cs_Name',
                    'Cs_Phone',
                    'email'
                )
                ->first();
            
            $mail_user = Auth::user()->email;
            $titleMail = 'Order';
        } else {
            LogCTRL::addToLog(314);//AÑADIENDO LOG DE LA IP

            $user = new \stdClass();
            $user->Cs_Name = Session::get('name');
            $user->Cs_Phone = Session::get('phone');
            $mail_user = Session::get('email');
            $user->Cs_ZipCode = '';
            $user->Cs_Number = '';
            $user->Cs_Street = '';
            $user->Cs_Notes = '';
            $titleMail = 'Quick Order';
           
            Session::forget('id_cart');
        }





        $correos = DB::table('emails_admin')->get();

        $logo = DB::table('config')
            ->where('Cfg_Descript', 'logo')
            ->first()
            ->Cfg_Message;
        
        $footer = DB::table('config')
            ->where('Cfg_Descript', 'footer')
            ->first()
            ->Cfg_Message;
        
        $order = DB::table('hd_tticket')->where('Hd_Ticket', $orderId)->first();
        
        $size = function ($size) {
            $size_topping = '';
            
            if ($size==1) {
                $size_topping = '(All)';
            } elseif ($size==2) {
                $size_topping = '(Left)';
            } elseif ($size==3) {
                $size_topping = '(Rigth)';
            } elseif ($size==4) {
                $size_topping = '(Extra)';
            } elseif ($size==5) {
                $size_topping = '(Lite)';
            }
            return $size_topping;
        };
        
        $variables_correo = [
            'order' => $order,
            
            'delivery' => $order->Hd_Delivery,
            'discount' => $order->Hd_Discount,
            'charge' => $order->Hd_Charge,
            'tip' => $order->Hd_Tips,

            'now' => Carbon::now()->format('m-d-Y'),
            'cart' => $cart,
            'title' => $titleMail,
            'size' => $size,// function
            'logo' => $logo,
            'footer' => $footer,
            'num_order' => $orderId,
            'phone' => $user->Cs_Phone,
            'name' => $user->Cs_Name,
            'email' => $mail_user,
            'street_num' => $user->Cs_Number,
            'street_name' => $user->Cs_Street,
            'zip_code' => $user->Cs_ZipCode,
        ];
        
        $isErrorToSend = SendMailCTRL::sendNow(
            'mail_template.order',
            $variables_correo,
            $mail_user,
            $titleMail
        );
        
        Mail::send('mail_template.order', $variables_correo, function ($msj) use ($correos, $titleMail) {
            $msj->subject($titleMail);
            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            foreach ($correos as $array => $admin) {
                $msj->to($admin->email);
            }
        });

        return $isErrorToSend;
    }
}
