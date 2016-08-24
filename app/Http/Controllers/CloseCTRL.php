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
    public function index($type)
    {
        if (static::hora()[0]) {
            return redirect()->to('/menu');
        }

        $logo = DB::table('config')
            ->where('Cfg_Descript', 'logo')
            ->first()
            ->Cfg_Message;

        if ($type == 'hour') {
            $mon = '';
            $tue = '';
            $wed = '';
            $thu = '';
            $fri = '';
            $sat = '';
            $sun = '';

            $data = [
                'logo' => $logo,
                'mon'=> $mon,
                'tue'=> $tue,
                'wed'=> $wed,
                'thu'=> $thu,
                'fri'=> $fri,
                'sat'=> $sat,
                'sun'=> $sun,
            ];

        } elseif ($type == 'mantenice') {
            $message = DB::table('config')
                ->where('Cfg_Descript', 'Message Close')
                ->first();

            $message = ($message) ? $message->Cfg_Message : '';
            
            $data = [
                'message' => $message,
                'logo' => $logo,
            ]; 

        } elseif ($type == 'holiday') {
            $date = Carbon::now()->format('Y-m-d');

            $holidayNow = DB::table('holiday_schedule')
                ->where('HS_Date', $date)
                ->first();

            $data = [
                'message' => $holidayNow->HS_Message,
                'logo' => $logo,
                'background' => $holidayNow->HS_Background,
                'title' => $holidayNow->HS_Title,
            ]; 

        }

        return view('closed')->with($data);
    }


    /**
    * [hora description]
    * @return [type] [description]
    */
    public static function hora()
    {
        $resp = true;
        $message = '';

        $close = DB::table('config')
            ->where('Cfg_Descript', 'Close Store')
            ->first();

        if ($close->Cfg_Status) {
            $resp = false;
            $message = 'mantenice';
        } elseif(static::holiday()) {
            $resp = false;
            $message = 'holiday';
        } elseif(static::days()) {
            $resp = false;
            $message = 'hour';
        }

        return [
            $resp,
            $message,
        ];
    }


    protected static function holiday()
    {
        $date = Carbon::now()->format('Y-m-d');

        $holidays = DB::table('holiday_schedule')
            ->where('HS_Date', $date)
            ->where('HS_Status', 0)
            ->first();

        if ($holidays) {
            return true;
        }

        return false;
    }


    protected static function dbDay($day)
    {
        return DB::table('config')
            ->where('Cfg_Descript', $day)
            ->select('Cfg_Open as open', 'Cfg_Close as close')
            ->first();
    }


    protected static function days()
    {
        $times = Carbon::now();
        
        $hora = $times->toTimeString();
        $dia = $times->format('l');

        $mon = static::dbDay('Monday');
        $tue = static::dbDay('Tuesday');
        $wed = static::dbDay('Wednesday');
        $thu = static::dbDay('Thursday');
        $fri = static::dbDay('Friday');
        $sat = static::dbDay('Saturday');
        $sun = static::dbDay('Sunday');

        if ($dia=="Monday" && $hora>=$mon->open && $hora<=$mon->close) {
            return false;
        } elseif ($dia=="Tuesday" && $hora>=$tue->open && $hora<=$tue->close) {
            return false;
        } elseif ($dia=="Wednesday" && $hora>=$wed->open && $hora<=$wed->close) {
            return false;
        } elseif ($dia=="Thursday" && $hora>=$thu->open && $hora<=$thu->close) {
            return false;
        } elseif ($dia=="Friday" && $hora>=$fri->open && $hora<=$fri->close) {
            return false;
        } elseif ($dia=="Saturday" && $hora>=$sat->open && $hora<=$sat->close) {
            return false;
        } elseif ($dia=="Sunday" && $hora>=$sun->open && $hora<=$sun->close) {
            return false;
        }

        return true;
    }


    public function now()
    {
        $times = Carbon::now()->format('Y-m-d');
        /*
        
        $hora = $times->toTimeString();
        $dia = $times->format('l');

        return 'Dia:'.$dia.'<br> Hora: '.$hora;
        */
        return var_dump($times);
    }
}
