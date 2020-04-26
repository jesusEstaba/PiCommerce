<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
use Session;
use Redirect;

class UserAcount extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = DB::table('users')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
            ->where('users.phone', Auth::user()->phone)
            ->first();

        /*
        Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString();
        $user->{'birthDay'} = ;
        $user->{'birthMonth'} = ;
        $user->{'birthYear'} = ;
        */

        return view('user_account')->with(['user'=>$user]);
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
        $changes = [];//users
        $updates = [];//customers
        $nameUpdates = [];

        /*
        $user = DB::table('users')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
            ->where('users.phone', Auth::user()->phone)
            ->first();
        */

        $changesUser = $this->modifyUserInfo([
            'Cs_Name' => [$request['name'], 'Name'],
            'Cs_ZipCode' => [$request['zip_code'], 'Zip Code'],
            'Cs_Number' => [$request['street_number'], 'Street Number'],
            'Cs_Street' => [$request['street_name'], 'Street Name'],
            'Cs_Ap_Suite' => [$request['aparment'], 'Aparment'],
            'Cs_Notes' => [$request['special_directions'], 'Special Directions'],
        ]);

        $nameUpdates += $changesUser['nameUpdates'];
        $updates += $changesUser['updates'];

        if (!empty($request['password'])){
            $changes['password'] = bcrypt($request['password']);;
            $nameUpdates[] = 'Password';
        }

        if (((int)$request['month_birthday']) != 0 &&
            ((int)$request['day_birthday']) != 0 &&
            ((int)$request['year_birthday']) != 0
        ){
            $request['Cs_Birthday'] = Carbon::createFromDate(
                $request['year_birthday'],
                $request['month_birthday'],
                $request['day_birthday']
            );
            $nameUpdates[] = 'Birthday';
        }

        if (count($updates) || count($changes)) {
            if (count($updates)) {
                DB::table('customers')
                    ->where('Cs_Phone', Auth::user()->phone)
                    ->update($updates);
            }

            if (count($changes)) {
                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update($changes);
            }

            Session::flash('message-correct', 'Changes have been saved');
        }

        $user = DB::table('users')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
            ->where('users.phone', Auth::user()->phone)
            ->first();

        return redirect('/account')->with(['nameUpdates'=>$nameUpdates]);
    }

    /**
     * [modifyUserInfo description]
     * @param  [type] $array [description]
     * @return [array]        [description]
     */
    private function modifyUserInfo($array)
    {
        $user = DB::table('users')
            ->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
            ->where('users.phone', Auth::user()->phone)
            ->first();

        $nameUpdates = [];
        $updates = [];

        foreach ($array as $key => $value) {
            $dato = $user->{$key};

            if (!empty($value[0]) && $dato!=$value[0]){
                $updates[$key] = $value[0];
                $nameUpdates[] = $value[1];
            }
        }

        return ['nameUpdates'=>$nameUpdates, 'updates'=>$updates];
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
