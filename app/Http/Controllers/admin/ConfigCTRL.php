<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        if (!empty(Input::file('logo'))) {
            $insert_to_db = [];

            if (!empty(Input::file('logo'))) {
                $logo = CategoriesCTRL::uploadImageServer(
                    Input::file('logo'),
                    'public_logo'
                );

                if ($logo) {
                    $insert_to_db['logo'] = $logo;
                }
                //delete dthe old element #Storage::delete('file.jpg');
            }

            if (count($insert_to_db)) {
                DB::table('config')->update($insert_to_db);
            }
        }
        if (!empty(Input::file('background'))) {
            $insert_to_db = [];

            if (!empty(Input::file('background'))) {
                $background = CategoriesCTRL::uploadImageServer(
                    Input::file('background'),
                    'public_background'
                );

                if ($background) {
                    $insert_to_db['background'] = $background;
                }

                //delete dthe old element #Storage::delete('file.jpg');
            }

            if (count($insert_to_db)) {
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

        if ($id==1) {
            if ($request['change_state']) {
                $status = (int)$request['status'];

                DB::table('config')->update([
                    'closed'=>$status
                ]);

                return response()->json("success");
            }
        } elseif ($id==2) {
            $numberDay = (int)$request['day'];

            if ($numberDay>0 && $numberDay<=7) {
                $daysOfTheWeek = [
                    'mon',
                    'tue',
                    'wed',
                    'thu',
                    'fri',
                    'sat',
                    'sun',
                ];
                $nameDay = $daysOfTheWeek[$numberDay-1];

                if (!($request['open'] === 'null:null')) {
                    $update[$nameDay.'_open'] = $request['open'];
                }

                if (!($request['close'] === 'null:null')) {
                    $update[$nameDay.'_close'] = $request['close'];
                }
            }
        } elseif ($id==3) {
            if ($request['social']==1) {
                $update['facebook'] = $request['url'];
            } elseif ($request['social']==2) {
                $update['twitter'] = $request['url'];
            } elseif ($request['social']==3) {
                $update['instagram'] = $request['url'];
            } elseif ($request['social']==4) {
                $update['gplus'] = $request['url'];
            }
        } elseif ($id==4) {
            if (!empty($request['footer'])) {
                $update['footer'] = $request['footer'];
            }
        } elseif ($id==5) {
            if (!empty($request['message'])) {
                $update['message_close'] = $request['message'];
            }
        }

        if (count($update)) {
            DB::table('config')->update($update);
            return response()->json(["change"=>$update]);
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
