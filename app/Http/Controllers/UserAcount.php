<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
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

        return view('user_account');
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

        if (!empty($request['password'])){
            $changes['password'] = bcrypt($request['password']);;
            $nameUpdates[] = 'Password';
        }

        if (!empty($request['name'])){
            $updates['Cs_Name'] = $request['name'];
            $nameUpdates[] = 'Name';
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

        if (!empty($request['zip_code'])){
            $updates['Cs_ZipCode'] = $request['zip_code'];
            $nameUpdates[] = 'Zip Code';
        }

        if (!empty($request['street_number'])){
            $updates['Cs_Number'] = $request['street_number'];
            $nameUpdates[] = 'Street Number';
        }

        if (!empty($request['street_name'])){
            $updates['Cs_Street'] = $request['street_name'];
            $nameUpdates[] = 'Street Name';
        }

        if (!empty($request['aparment'])){
            $updates['Cs_Ap_Suite'] = $request['aparment'];
            $nameUpdates[] = 'Aparment';
        }

        // if (!empty($request['aparment_complex'])){
        //     $updates['Cs_'] = $request['aparment_complex'];
        // }

        // if (!empty($request['city'])){
        //     $updates['Cs_'] = $request['city'];
        // }

        if (!empty($request['special_directions'])){
            $updates['Cs_Notes'] = $request['special_directions'];
            $nameUpdates[] = 'Special Directions';
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

        return view('user_account')->with('nameUpdates',$nameUpdates);
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
