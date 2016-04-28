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
        /*
        $config_data = DB::table('config')
            ->select()
            ->first();
        */
        $logo = DB::table('config')
            ->where('Cfg_Descript', 'logo')
            ->first()
            ->Cfg_Message;

        $mon = '';
        $tue = '';
        $wed = '';
        $thu = '';
        $fri = '';
        $sat = '';
        $sun = '';
        $message = '';
        /*
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
        */

        return view('closed')->with([
            'message' => $message,
            'logo' => $logo,
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
        $close = DB::table('config')
            ->where('Cfg_Descript', 'Close Store')
            ->first();

        if (!$close->Cfg_Status) {
            $times = Carbon::now();
            $hora = $times->toTimeString();
            $dia = $times->format('l');

            $mon = DB::table('config')
                ->where('Cfg_Descript', 'Monday')
                ->first();
            $tue = DB::table('config')
                ->where('Cfg_Descript', 'Tuesday')
                ->first();
            $wed = DB::table('config')
                ->where('Cfg_Descript', 'Wednesday')
                ->first();
            $thu = DB::table('config')
                ->where('Cfg_Descript', 'Thursday')
                ->first();
            $fri = DB::table('config')
                ->where('Cfg_Descript', 'Friday')
                ->first();
            $sat = DB::table('config')
                ->where('Cfg_Descript', 'Saturday')
                ->first();
            $sun = DB::table('config')
                ->where('Cfg_Descript', 'Sunday')
                ->first();

            if ($dia=="Monday" && $hora>=$mon->Cfg_Open && $hora<=$mon->Cfg_Close) {
                return true;
            } elseif ($dia=="Tuesday" && $hora>=$tue->Cfg_Open && $hora<=$tue->Cfg_Close) {
                return true;
            } elseif ($dia=="Wednesday" && $hora>=$wed->Cfg_Open && $hora<=$wed->Cfg_Close) {
                return true;
            } elseif ($dia=="Thursday" && $hora>=$thu->Cfg_Open && $hora<=$thu->Cfg_Close) {
                return true;
            } elseif ($dia=="Friday" && $hora>=$fri->Cfg_Open && $hora<=$fri->Cfg_Close) {
                return true;
            } elseif ($dia=="Saturday" && $hora>=$sat->Cfg_Open && $hora<=$sat->Cfg_Close) {
                return true;
            } elseif ($dia=="Sunday" && $hora>=$sun->Cfg_Open && $hora<=$sun->Cfg_Close) {
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
