<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Storage;
use File;
use Input;


class ConfigCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = DB::table('config')->first();

        return view('admin.config.index')->with(['config'=>$config]);
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
        if(!empty( Input::file('logo') ))
        {
            $insert_to_db = [];
            
            if( !empty( Input::file('logo') ) )
            {
                $logo = CategoriesCTRL::upload_image_sys(Input::file('logo'), 'public_logo');
                
                if($logo)
                    $insert_to_db['logo'] = $logo;

                //delete dthe old element #Storage::delete('file.jpg');
            }

            if( count($insert_to_db) ){
                DB::table('config')->update($insert_to_db);
            }

            
        }
        if(!empty( Input::file('background') ))
        {
            $insert_to_db = [];
            
            if( !empty( Input::file('background') ) )
            {
                $background = CategoriesCTRL::upload_image_sys(Input::file('background'), 'public_background');
                
                if($background)
                    $insert_to_db['background'] = $background;

                //delete dthe old element #Storage::delete('file.jpg');
            }

            if( count($insert_to_db) ){
                DB::table('config')->update($insert_to_db);
            }

            
        }
        return response()->json("created");
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
        $update = [];

        if($id==1)
        {
            if($request['change_state'])
            {
                $status = (int)$request['status'];

                DB::table('config')->update([
                    'closed'=>$status
                ]);

                return response()->json("success");
            }
        }
        else if($id==2)
        {
            if($request['day']==1)
            {
                if($request['open'])
                    $update['mon_open'] = $request['open'];
                if($request['close'])
                    $update['mon_close'] = $request['close'];
            }
            else if($request['day']==2)
            {
                if($request['open'])
                    $update['tue_open'] = $request['open'];
                if($request['close'])
                    $update['tue_close'] = $request['close'];
            }
            else if($request['day']==3)
            {
                if($request['open'])
                    $update['wed_open'] = $request['open'];
                if($request['close'])
                    $update['wed_close'] = $request['close'];
            }
            else if($request['day']==4)
            {
                if($request['open'])
                    $update['thu_open'] = $request['open'];
                if($request['close'])
                    $update['thu_close'] = $request['close'];
            }
            else if($request['day']==5)
            {
                if($request['open'])
                    $update['fri_open'] = $request['open'];
                if($request['close'])
                    $update['fri_close'] = $request['close'];
            }
            else if($request['day']==6)
            {
                if($request['open'])
                    $update['sat_open'] = $request['open'];
                if($request['close'])
                    $update['sat_close'] = $request['close'];
            }
            else if($request['day']==7)
            {
                if($request['open'])
                    $update['sun_open'] = $request['open'];
                if($request['close'])
                    $update['sun_close'] = $request['close'];
            }
        }
        else if($id==3)
        {
            if($request['social']==1)
            {
                $update['facebook'] = $request['url'];
            }
            else if($request['social']==2)
            {
                $update['twitter'] = $request['url'];
            }
            else if($request['social']==3)
            {
                $update['instagram'] = $request['url'];
            }
            else if($request['social']==4)
            {
                $update['gplus'] = $request['url'];
            }
        }
        else if($id==4)
        {
            if(!empty($request['footer']))
            {
                $update['footer'] = $request['footer'];
            }
        }
        else if($id==5)
        {
            if(!empty($request['message']))
            {
                $update['message_close'] = $request['message'];
            }
        }

        if( count($update) )
        {
            DB::table('config')->update($update);
            return response()->json("change!");
        }

        return response()->json("empty");
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
