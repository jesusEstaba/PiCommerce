<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Session;

class CouponsCTRL extends Controller
{
    /**
     * [return_discount description]
     * @param  [type] $coupon [description]
     * @return [type]         [description]
     */
    public static function return_discount($coupon)
    {
        $cupon = CouponsCTRL::query_coupon($coupon);
        if($cupon)
        {
            $resp = ['discount'=>(float)$cupon->discount]; 
            
            Session::put('coupon_discount', $cupon->discount);
            
            Session::put('coupon_id', CouponsCTRL::valid_coupon($coupon) );
        }
        else
        {
            $resp = ['discount'=>0];
        }

        return response()->json($resp);
    }

    /**
     * [query_coupon description]
     * @param  [type] $code_coupon [description]
     * @return [type]              [description]
     */
    public static function query_coupon($code_coupon)
    {
        $cupon = DB::table('coupons')
            ->where('code', 'like',$code_coupon)
            ->where('rot', '>=', \Carbon\Carbon::now()->format('d-m-Y'))
            ->first();
        return $cupon;
    }


    /**
     * [use_coupon description]
     * @param  [type] $code_coupon [description]
     * @param  [type] $id_order    [description]
     * @return [type]              [description]
     */
    public static function valid_coupon($code_coupon)
    {
        $cupon = CouponsCTRL::query_coupon($code_coupon);
        
        if($cupon)
        {
            return (int)$cupon->id;
        }    
        return 0;
    }

    public static function use_coupon($id_order, $coupon_id)
    {
        if($coupon_id)
        {
            DB::table('coupons_logs')->insert([
                'coupon_id'=> $coupon_id,
                'order_id'=> $id_order,
                'used'=> \Carbon\Carbon::now(),
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
        $coupons = DB::table('coupons_logs')
            ->join('coupons', 'coupons_logs.coupon_id', '=', 'coupons.id')
            ->select(
                'coupons.id' ,
                'coupons.code' ,
                'coupons.discount' ,
                'coupons.rot',
                 DB::raw('coupons_logs.coupon_id, count(*) used')
            )
            ->groupBy('coupons_logs.coupon_id')
            ->paginate(15);

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
        if( !empty($request['code']) && !empty($request['disc']) && !empty($request['date']) )
        {
            DB::table('coupons')->insert([
                'code' => $request['code'],
                'discount' => $request['disc'],
                'rot' => $request['date'],
                'created_at' => \Carbon\Carbon::now(),
            ]);
            return response()->json("New Coupon");
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
