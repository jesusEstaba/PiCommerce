<?php

namespace Pizza\Http\Controllers\admin;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

class LogsCTRL extends Controller
{
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
