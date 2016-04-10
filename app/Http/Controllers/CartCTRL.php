<?php
/**
 * Cumple el Estándar PSR-2
 */
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
     * [add_ajax description]
     * @param Request $request [description]
     */
    public function addAjax(Request $request)
    {
        if (Auth::check()) {
            $this->loadItemToCart(
                $request['id_size'],
                $request['toppings_id'],
                $request['toppings_size'],
                $request['cooking_notes'],
                $request['quantity']
            );

            $response = ['status'=>'online'];
        } else {
            Session::put('size', $request['id_size']);
            Session::put('topping', $request['toppings_id']);
            Session::put('topping_size', $request['toppings_size']);
            Session::put('cooking_instructions', $request['cooking_notes']);
            Session::put('quantity', $request['quantity']);

            $response = ['status'=>'offline'];
        }

        return response()->json($response);
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

        $deleteRespn = DB::table('cart')
            ->where('id_user', Auth::user()->id)
            ->where('id', $id)
            ->delete();

        return response()->json(['state' => $deleteRespn,]);
    }


    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        if (Session::has('size')) {
            //funcion que carga el producto a la db
            $this->loadItemToCart(
                Session::get('size'),
                Session::get('topping'),
                Session::get('topping_size'),
                Session::get('cooking_instructions'),
                Session::get('quantity')
            );

            Session::forget('size');
            Session::forget('toppings');
            Session::forget('topping_size');
            Session::forget('cooking_instructions');
            Session::forget('quantity');
        }

        $cart = CartCTRL::searchCartItems();

        if (!isset($size)) {
            $size = "";
        }

        if (!isset($toppings)) {
            $toppings = "";
        }

        return view('cart')->with(['cart'=>$cart]);
    }


    public function back()
    {
        return redirect()->back();
    }


    /**
     * [searchCartItems description]
     * @param  string $asc [description]
     * @return [type]      [description]
     */
    public static function searchCartItems($asc = '', $idCart = '')
    {
        if ($asc==='asc') {
            $orderByCart = 'asc';
        } else {
            $orderByCart = 'desc';
        }

        if ($idCart == '') {
            $idUserTemp = Auth::user()->id;
        } else {
            $idUserTemp = 314;
        }

        $cart = DB::table('cart')
            ->join('size', 'size.Sz_Id', '=', 'cart.product_id')
            ->join('items', 'items.It_Id', '=', 'size.Sz_Item')
            ->where('cart.id_user', $idUserTemp)
            ->where(
                function ($query) use ($idCart) {
                    if ($idCart) {
                        $query->where('id', $idCart);
                    }
                }
            )
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
            ->orderBy('cart.id', $orderByCart)
            ->get();


        foreach ($cart as $key => $value) {
            $toppingsList = DB::table('cart_top')
                ->join('toppings', 'toppings.Tp_Id', '=', 'cart_top.id_topping')
                ->where('id_cart', $value->id)
                ->orderBy('id_cart')
                ->select(
                    'toppings.Tp_Id',
                    'toppings.Tp_Descrip',
                    'cart_top.price',
                    'cart_top.size'
                )
                ->get();

            $value->{'toppings_list'} = $toppingsList;
        }

        return $cart;
    }


    /**
     * [Devuelve el total del precio del carrito]
     * @param  boolean $res
     * void:devuelve la respuesta en json.
     * true:devuelve el precio en número.
     * @return [json || float]
     */
    public static function totalCostCart($res = false)
    {
        $totalCart = DB::table('cart')
            ->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
            ->where('cart.id_user', Auth::user()->id)
            ->selectRaw('sum(cart_top.price*cart.quantity) as toppings')
            ->orderBy('cart_top.id_cart')
            ->get();

        if ($totalCart) {
            $totalCartTwo = DB::table('cart')
                ->join('size', 'size.Sz_Id', '=', 'cart.product_id')
                ->where('cart.id_user', Auth::user()->id)
                ->selectRaw('sum(size.Sz_Price*cart.quantity) as pizza')
                ->orderBy('cart.id')
                ->get();

            if ($totalCartTwo) {
                $totalCartTwo = $totalCartTwo[0]->pizza;
            } else {
                $totalCartTwo = 0;
            }

            $total = $totalCart[0]->toppings + $totalCartTwo;
        } else {
            $total = 0.00;
        }

        if ($res===true) {
            return $total;
        }

        return response()->json(['total' => $total]);
    }


    /**
     * [loadItemToCart description]
     * @param  [type] $size                 [description]
     * @param  [type] $toppings             [description]
     * @param  [type] $topSize             [description]
     * @param  [type] $cookingInstructions [description]
     * @param  [type] $quantity             [description]
     * @return [type]                       [description]
     */
    public static function loadItemToCart(
        $size,
        $toppings,
        $topSize,
        $cookingInstructions,
        $quantity,
        $quick = false
    )
    {
        $idCart = 0;

        $quantity = (int)$quantity;

        if (!$quantity) {
            $quantity = 1;
        }

        if ($quick) {
            $userIdCart = 314;
        } else {
            $userIdCart = Auth::user()->id;
        }

        $idCart = DB::table('cart')->insertGetId(
            [
            'id_user' => $userIdCart,
            'product_id' => $size,
            'cooking_instructions' => trim($cookingInstructions),
            'quantity' => $quantity,
            ]
        );

        $sizePrice = DB::table('size')
            ->where('Sz_Id', $size)
            ->select('Sz_Topprice as szTop', 'Sz_Topprice2 as szTopTwo')
            ->first();

        $toppingPrice = (float)$sizePrice->szTop;
        $toppingPriceTwo = (float)$sizePrice->szTopTwo;

        if (!is_array($toppings)) {
            $toppings = explode(',', $toppings);
            $topSize = explode(',', $topSize);
        }

        $arrSize = count($toppings);

        for ($indice = 0; $indice < $arrSize; $indice++) {
            $idTop = (int)$toppings[$indice];
            $sizeTopId = (int)$topSize[$indice];

            if ($idTop) {
                $topping = DB::table('toppings')
                    ->where('Tp_Id', $idTop)
                    ->select(
                        'Tp_Topprice as tpTopPrice',
                        'Tp_Double as tpDouble',
                        'Tp_Kind as tpKind'
                    )
                    ->first();

                if ($topping->tpKind != 4) {
                    $tpTopPrice =  $topping->tpTopPrice;
                    $tpDouble =  $topping->tpDouble;
                    $priceTopNew = 0;

                    if ($tpTopPrice>0) {
                        $priceTopNew = (float)$tpTopPrice;
                    } else {
                        if ($tpDouble=='N') {
                            $priceTopNew = (float)$toppingPrice;
                        } else {
                            $priceTopNew = (float)$toppingPriceTwo;
                        }
                    }

                    if ($sizeTopId==1 ||  $sizeTopId==5) {
                        $priceTopNew *= 1;
                    } elseif ($sizeTopId==2 ||  $sizeTopId==3) {
                        $priceTopNew *= 1/2;
                    } elseif ($sizeTopId==4) {
                        $priceTopNew *= 2;
                    }
                } else {
                    $sizeTopId = 6;
                    $priceTopNew = 0;
                }

                DB::table('cart_top')->insert(
                    [
                    'id_cart' => $idCart,
                    'id_topping' => $idTop,
                    'price' => round($priceTopNew, 2),
                    'size' => $sizeTopId
                    ]
                );
            }
        }


        if ($quick) {
            return $idCart;
        }
    }
}
