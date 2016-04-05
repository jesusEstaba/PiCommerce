<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;


class LogCTRL extends Controller
{
    /**
     * [add_to_log description]
     * @param [type] $action [description]
     */
    public static function addToLog($action)
    {
        if( \Auth::check() || $action==314 )
        {
            $ip = $_SERVER['REMOTE_ADDR'];
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            
            $ISP = '';

            if($query && $query['status'] == 'success')
            {
              $ISP = $query['isp'];
            }
                
            if($action==314)
            {
                 $id_user = 314;
            }
            else
            {
               $id_user = \Auth::user()->id;
            }

            DB::table('ip_logs_user')->insert([
                'id_user'=> $id_user,
                'ip'=> $ip,
                'created_at'=>\Carbon\Carbon::now(),
                'action'=>$action,
                'ISP'=>$ISP,
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
        $ip_log = DB::table('ip_logs_user')
            ->leftJoin('users', 'users.id', '=', 'ip_logs_user.id_user')
            ->select('users.email', 'ip_logs_user.*')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.logs.index')->with(['ip_log'=>$ip_log]);
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
        $logs = DB::table('ip_logs_user')
            ->where('id_user', $id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('admin.logs.log')->with([
            'id'=>$id,
            'logs'=>$logs,
            'user'=>$user,

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
