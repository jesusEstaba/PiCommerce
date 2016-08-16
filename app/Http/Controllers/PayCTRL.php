<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Session;

class PayCTRL extends Controller
{
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index(Request $request, $select = '')
    {
        /**
         * Revisar las condiciones cuando sea Quick, Delivery o Pickup
         */

        if (isset($request['PaymentID'])) {
            $existOrder = DB::table('hd_tticket')
                ->where('Hd_PaymentId', $request['PaymentID'])
                ->where('Hd_Status', 0)
                ->first();
            
            if ($existOrder) {
                DB::table('hd_tticket')
                    ->where('Hd_PaymentId', $request['PaymentID'])
                    ->delete();

                DB::table('dt_tticket')
                    ->where('Dt_Ticket', $existOrder->Hd_Ticket)
                    ->delete();

                DB::table('dt_topping')
                    ->where('DTt_Ticket', $existOrder->Hd_Ticket)
                    ->delete();
            }
        } 

        //ver si hay errores con la session
        if (Auth::check() || (Session::has('id_cart') && Session::has('email'))) {
            $cart = '';
            if (Auth::check()) {
                Session::forget('cart');

                $cart = CartCTRL::searchCartItems('combo');#podria cargarlo desde un Session
                Session::put('cart', $cart);
            }


            if(!$cart) {
                $idCartSession = (int)Session::get('id_cart');
                $cart = CartCTRL::searchCartItems('asc', $idCartSession);
            }

            if ($cart) {
                if (Session::has('id_cart')) {
                    $idCartSession = (int)Session::get('id_cart');

                    $total_in_cart = CartCTRL::totalCostCart(true, $idCartSession);

                    $user = new \stdClass();
                    $user->Cs_Name = Session::get('name');
                    $user->Cs_Phone = Session::get('phone');
                    $user->email = Session::get('email');
                    $user->Cs_ZipCode = 0;

                } else {
                    $total_in_cart = CartCTRL::totalCostCart(true);

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
                }

                $tax = DB::table('taxes')
                    ->select('Tx_Base')
                    ->first();

                //pasar a la condicion del delivery
                $delivery_val = DB::table('password1')
                    ->select('G_Value')
                    ->where('G_Id', 5)
                    ->first();

                $minValue = DB::table('password1')
                    ->select('G_Value')
                    ->where('G_Description', 'Minimun_order')
                    ->first();

                if ($minValue) {
                    $minValue = $minValue->G_Value;
                } else {
                    $minValue = 0;
                }

                //pasar a la condicion del delivery
                $fee = DB::table('payform')
                    ->select('Pf_Charge')
                    ->where('Pf_Id', 2)
                    ->first();

                $valid_zip_code = DB::table('street')
                    ->where('St_ZipCode', $user->Cs_ZipCode)
                    ->first();

                $delivery = false;

                if ($valid_zip_code) {
                    $delivery = true;
                }

                $ip_user = $_SERVER['REMOTE_ADDR'];
                $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip_user));

                $isp_user = '';
                if ($query && $query['status'] == 'success') {
                    $isp_user = $query['isp'];
                }

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


                #Calculos
                $total_cart = (float)$total_in_cart;
                $tax = (float)$tax->Tx_Base;
                $fee = (float)$fee->Pf_Charge;
                $delivery_value = 0;

                if ($delivery && $select=='delivery') {
                    $delivery_value = (float)$delivery_val->G_Value;
                }

                $taxs = $total_cart * $tax / 100;
                $total_to_pay = $total_cart + $taxs + $delivery_value + $fee;
                #EndCalculos

                $total_cart = number_format($total_cart, 2);
                $taxs = number_format($taxs, 2);
                $delivery_value = number_format($delivery_value, 2);
                $fee = number_format($fee, 2);
                $total_to_pay = number_format($total_to_pay, 2);

                $delivery_date = Carbon::now()->format('m-d-Y');

                return view('checkout.pay')->with([
                    'cart' => $cart,
                    'size' => $size,
                    'select'=> $select,
                    'user' => $user,
                    'delivery'=> $delivery,
                    'ip_user' => $ip_user,
                    'tax' => $tax,
                    'total_cart' => $total_cart,
                    'taxs' => $taxs,
                    'delivery_value' => $delivery_value,
                    'fee' => $fee,
                    'total_to_pay' => $total_to_pay,
                    'delivery_date' => $delivery_date,
                    'isp_user' => $isp_user,
                    'minValue'=> $minValue,
                ]);
            }
        }

        if ($select=='quick') {
            return redirect()->to('checkout/quick');
        }

        return view('checkout.empty');
    }


    /**
    * [select description]
    * @return [type] [description]
    */
    public function select()
    {
        return view('checkout.selection');
    }
}
