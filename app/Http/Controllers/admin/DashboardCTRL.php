<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class DashboardCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profitMonth($ano, $mes)
    {
        $min_month = Carbon::create($ano, $mes, 1, 0);
        $max_month = Carbon::create($ano, $mes, 1, 0)->endOfMonth();

        return DB::table('hd_tticket')
            ->whereBetween('Hd_Date', [$min_month, $max_month])
            ->where('Hd_Status', '1')
            ->sum('Hd_Total');
    }

    public function index(Request $request)
    {
        $times = Carbon::now();
        //$hora = $times->toTimeString();
        //$dia = $times->format('l');
        $min_month = Carbon::create(
            $times->format('Y'),
            $times->format('m'),
            1,
            0
        );

        $max_month = Carbon::create(
            $times->format('Y'),
            $times->format('m'),
            1,
            0
        )->endOfMonth();

        $profit_month = $this->profitMonth($times->format('Y'), $times->format('m'));


        $today = $times->format('l jS \of F Y');
        $date = $times->format('Y-m-d');

        $num = $request->get('num');

        if (!empty($num)) {
            $orders = DB::table('hd_tticket')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'hd_tticket.Hd_Customers')
            ->where('hd_tticket.Hd_Ticket', $num)
            ->where('Hd_Ticket', '!=', '1')
            ->where('Hd_Date', '>=', $date)
            ->select(
                'customers.Cs_Name',
                'hd_tticket.Hd_Ticket',
                'hd_tticket.Hd_Date',
                'hd_tticket.Hd_Total',
                'Hd_Status'
            )
            ->orderBy('hd_tticket.Hd_Ticket', 'desc')
            ->paginate(5);
        } else {
            $orders = DB::table('hd_tticket')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'hd_tticket.Hd_Customers')
            ->where('Hd_Ticket', '!=', '1')
            ->where('Hd_Date', '>=', $date)
            ->select(
                'customers.Cs_Name',
                'hd_tticket.Hd_Ticket',
                'hd_tticket.Hd_Date',
                'hd_tticket.Hd_Total',
                'Hd_Status'
            )
            ->orderBy('hd_tticket.Hd_Ticket', 'desc')
            ->paginate(5);
        }

        $num_user = DB::table('users')->count();

        $pendientes = DB::table('hd_tticket')
            ->whereBetween('Hd_Date', [$min_month, $max_month])
            ->where(
                function ($query) {
                    $query->where('Hd_Status', 0)->orWhere('Hd_Status', null);
                }
            )
            ->count();

        $new_orders = DB::table('hd_tticket')
            ->whereBetween('Hd_Date', [$min_month, $max_month])
            ->where('Hd_Status', '1')
            ->count();

        $data_month = [];
        $number_months = [];

        for ($i = 1; $i <= $times->format('m'); $i++) {
            $data_month[] = $this->profitMonth($times->format('Y'), $i);
            $number_months[] = $i-1;
        }

        return view('admin.home')->with([
            'number_months'=>$number_months,
            'data_month'=>$data_month,
            'new_orders'=>$new_orders,
            'profit_month'=>$profit_month,
            'orders'=>$orders,
            'today'=>$today,
            'pendientes'=>$pendientes,
            'num_user'=>$num_user,
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
        //
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
