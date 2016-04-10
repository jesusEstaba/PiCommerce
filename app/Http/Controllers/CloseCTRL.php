<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;

class CloseCTRL extends Controller
{
    /**
    * [index description]
    * @return [type] [description]
    */
    public function index()
    {
        if ($this->hora()) {
            return redirect()->to('/choose');
        }

        $config_data = DB::table('config')
            ->select()
            ->first();

        $mon = '';
        $tue = '';
        $wed = '';
        $thu = '';
        $fri = '';
        $sat = '';
        $sun = '';
        $message = '';

        if ($config_data->closed) {
            $message = $config_data->message_close;
        } else {
            $mon = $config_data->mon_open.'-'.$config_data->mon_close;
            $tue = $config_data->tue_open.'-'.$config_data->tue_close;
            $wed = $config_data->wed_open.'-'.$config_data->wed_close;
            $thu = $config_data->thu_open.'-'.$config_data->thu_close;
            $fri = $config_data->fri_open.'-'.$config_data->fri_close;
            $sat = $config_data->sat_open.'-'.$config_data->sat_close;
            $sun = $config_data->sun_open.'-'.$config_data->sun_close;
        }

        return view('closed')->with([
            'message' => $message,
            'mon'=> $mon,
            'tue'=> $tue,
            'wed'=> $wed,
            'thu'=> $thu,
            'fri'=> $fri,
            'sat'=> $sat,
            'sun'=> $sun
        ]);
    }


    /**
    * [hora description]
    * @return [type] [description]
    */
    public static function hora()
    {
        $days = DB::table('config')
        ->select()
        ->first();
        if (!$days->closed) {
            $times = Carbon::now();
            $hora = $times->toTimeString();
            $dia = $times->format('l');

            if ($dia=="Monday" && $hora>=$days->mon_open && $hora<=$days->mon_close) {
                return true;
            } elseif ($dia=="Tuesday" && $hora>=$days->tue_open && $hora<=$days->tue_close) {
                return true;
            } elseif ($dia=="Wednesday" && $hora>=$days->wed_open && $hora<=$days->wed_close) {
                return true;
            } elseif ($dia=="Thursday" && $hora>=$days->thu_open && $hora<=$days->thu_close) {
                return true;
            } elseif ($dia=="Friday" && $hora>=$days->fri_open && $hora<=$days->fri_close) {
                return true;
            } elseif ($dia=="Saturday" && $hora>=$days->sat_open && $hora<=$days->sat_close) {
                return true;
            } elseif ($dia=="Sunday" && $hora>=$days->sun_open && $hora<=$days->sun_close) {
                return true;
            }
        }

        return false;
    }


    public function now()
    {
        $times = Carbon::now();
        $hora = $times->toTimeString();
        $dia = $times->format('l');

        return 'Dia:'.$dia.'<br> Hora: '.$hora;
    }
}
