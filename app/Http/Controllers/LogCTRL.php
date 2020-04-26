<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;


class LogCTRL extends Controller
{
    /**
     * [add_to_log description]
     * @param [type] $action [description]
     */
    public static function addToLog($action)
    {
        if (Auth::check() || $action==314) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            $isp = '';

            if ($query && $query['status'] == 'success') {
                $isp = $query['isp'];
            }

            if ($action==314) {
                 $id_user = 314;
            } else {
                $id_user = Auth::user()->id;
            }

            DB::table('ip_logs_user')->insert([
                'id_user'=> $id_user,
                'ip'=> $ip,
                'created_at'=>\Carbon\Carbon::now(),
                'action'=>$action,
                'ISP'=>$isp,
            ]);
        }
    }
}
