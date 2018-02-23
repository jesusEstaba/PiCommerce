<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers\admin;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class CouponsCTRL extends Controller
{
    /**
     * [return_discount description]
     * @param  [type] $coupon [description]
     * @return [type]         [description]
     */
    public static function returnDiscountCoupon($coupon)
    {
        $cupon = CouponsCTRL::queryDiscountCoupon($coupon);
        if ($cupon) {
            Session::put('coupon_discount', $cupon->discount);
            Session::put('coupon_type', $cupon->Cp_Type);
            Session::put('coupon_id', CouponsCTRL::validDiscountCoupon($coupon));

            $resp = ['discount'=>(float)$cupon->discount, 'type'=>$cupon->Cp_Type];
        } else {
            $resp = ['discount'=>0];
        }

        return response()->json($resp);
    }

    /**
     * [query_coupon description]
     * @param  [type] $code_coupon [description]
     * @return [type]              [description]
     */
    public static function queryDiscountCoupon($code_coupon)
    {
        $cupon = DB::table('coupons')
            ->where('code', 'like', $code_coupon)
            ->where('rot', '>=', Carbon::now())
            ->where('Cp_Status', 0)
            ->first();

        return $cupon;
    }


    /**
     * [use_coupon description]
     * @param  [type] $code_coupon [description]
     * @param  [type] $id_order    [description]
     * @return [type]              [description]
     */
    public static function validDiscountCoupon($code_coupon)
    {
        $cupon = CouponsCTRL::queryDiscountCoupon($code_coupon);

        if ($cupon) {
            return (int)$cupon->id;
        }
        return 0;
    }

    public static function useDiscountCoupon($id_order, $coupon_id)
    {
        if ($coupon_id) {
            DB::table('coupons_logs')->insert([
                'coupon_id'=> $coupon_id,
                'order_id'=> $id_order,
                'used'=> Carbon::now(),
            ]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = DB::table('coupons')->paginate(15);

        foreach ($coupons as $arr => $data) {
            $num_coupon_used = DB::table('coupons_logs')
                ->where('coupon_id', $data->id)
                ->count();

            $data->{'used'} = $num_coupon_used;
        }

        return view('admin.coupons.index')->with([
            'coupons'=>$coupons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request['code']) && !empty($request['disc']) && !empty($request['date'])) {
            $id_cupon = DB::table('coupons')->insertGetId([
                'code' => $request['code'],
                'discount' => $request['disc'],
                'rot' => $request['date'],
                'Cp_Type' => $request['type_disc'],
                'created_at' => Carbon::now(),
            ]);

            if ($id_cupon) {
                return response()->json("New Coupon");
            }

            return response()->json("Coupon Error");
        }

        return response()->json("error");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('coupons')
            ->where('id', $id)
            ->first();

        $cupon_log= DB::table('coupons_logs')
            ->where('coupon_id', $id)
            ->paginate(5);

        return view('admin.coupons.coupon')->with([
            'data'=>$data,
            'cupon_log'=>$cupon_log
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
