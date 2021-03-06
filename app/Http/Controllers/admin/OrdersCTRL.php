<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Input;

class OrdersCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $num = Input::get('num');

        $orders = DB::table('hd_tticket')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'hd_tticket.Hd_Customers')
            ->where(
                function ($query) use ($num) {
                    if ($num) {
                        $query->where('hd_tticket.Hd_Ticket', $num);
                    }
                }
            )
            ->select(
                'customers.Cs_Name',
                'hd_tticket.Hd_Ticket',
                'hd_tticket.Hd_Date',
                'hd_tticket.Hd_Total',
                'Hd_Status'
            )
            ->orderBy('hd_tticket.Hd_Ticket', 'desc')
            ->paginate(15);

        return view('admin.orders.index')->with(['orders'=>$orders]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = DB::table('hd_tticket')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'hd_tticket.Hd_Customers')
            ->leftJoin('users', 'users.phone', '=', 'hd_tticket.Hd_Customers')
            ->join('payform', 'payform.Pf_Id', '=', 'Hd_Payform')
            ->where('Hd_Ticket', $id)
            ->first();

        $products = false;

        if ($order) {
            $products = DB::table('dt_tticket')
            ->join('size', 'size.Sz_Id', '=', 'dt_tticket.Dt_Size')
            ->join('food', 'food.F_Abrev', '=', 'dt_tticket.Dt_FArea')
            ->where('Dt_Ticket', $order->Hd_Ticket)
            ->select(
                'Dt_Id',
                'Dt_Qty',
                'Dt_Price',
                'Dt_TopPrice',
                'Dt_Total',
                'Dt_Detail',
                'Dt_Detail',
                'F_Descripc',
                'Sz_Abrev'
            )
            ->get();

            foreach ($products as $key => $product) {
                $toppings = DB::table('dt_topping')
                    ->where('DTt_SzId', $product->Dt_Id)
                    ->get();

                $product->{'topppings'} =  $toppings;
            }
        }

        return view('admin.orders.order')->with([
            'order'=>$order,
            'products'=>$products
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
        $respuesta = 'Error';

        if (isset($request['change_visible'])) {
            $id = (int)$id;

            if ($id != 0) {
                $status  = (int)$request['status'];

                DB::table('hd_tticket')
                    ->where('Hd_Ticket', $id)
                    ->update(['Hd_Status'=>$status]);

                $respuesta = ['state'=>'Changed', $status];
            } else {
                $respuesta ="empty";
            }
        }

        return response()->json($respuesta);
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
