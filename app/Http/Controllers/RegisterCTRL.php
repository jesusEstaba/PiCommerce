<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Pizza\User;
use Redirect;
use Session;
use DB;
use Auth;
use GuzzleHttp\Client;

class RegisterCTRL extends Controller
{
    public function index()
    {
        $codes = DB::select('SELECT * from street where St_City = ?', ['Orlando']);
        $streets = DB::select('SELECT distinct St_ZipCode from street');

        return view('register')->with(['codes'=>$codes, 'streets'=>$streets]);
    }

    public function register(Request $request)
    {
        $secretKey = '6LdrFB0TAAAAAGKvs-WNMXulyCbpB81xFaM0jj5k';
        $gReCaptcha = $request['g-recaptcha-response'];

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$gReCaptcha;
        $jsonObj = file_get_contents($url);
        $json = json_decode($jsonObj, true);

        if ($json['success']) {
            if (!empty($request['password']) &&
                !empty($request['email']) &&
                !empty($request['phone']) &&
                !empty($request['name']) &&
                !empty($request['street_number']) &&
                !empty($request['zip_code']) &&
                !empty($request['street_name'])
            ) {
                $datos = DB::table('users')
                    ->where('email', $request['email'])
                    ->select('users.id')
                    ->get();

                $datos_phone = DB::table('customers')
                    ->where('Cs_Phone', $request['phone'])
                    ->select('Cs_Phone')
                    ->get();

                if (!$datos && !$datos_phone) {
                    DB::table('users')->insert([
                        'password' => bcrypt($request['password']),
                        'email' => $request['email'],
                        'phone'=> $request['phone'],
                        'dir_ip'=> $_SERVER['REMOTE_ADDR'],
                    ]);

                    DB::table('customers')->insert([
                        'Cs_Email1' => $request['email'],
                        'Cs_Phone'=> $request['phone'],
                        'Cs_Name' => $request['name'],

                        'Cs_Company' => $request['company'],
                        'Cs_Number' => $request['street_number'],
                        'Cs_Street' => $request['street_name'],
                        /*
                        '' => $request['aparment'],
                        '' => $request['aparment_complex'],
                        '' => $request['complex_name'],
                        '' => $request['city'],
                        */
                        'Cs_ZipCode' => $request['zip_code'],
                        'Cs_Notes' => $request['special_directions'],
                        'Cs_Birthday'=>$request['birthday']
                    ]);


                    Session::flash('message', 'User Registered!');

                    $credentials = [
                        'email'=>$request['email'],
                        'password'=>$request['password']
                    ];

                    if (Auth::attempt($credentials)) {
                        LogCTRL::addToLog(6);
                        return Redirect::to('cart');
                    }
                } else {
                    Session::flash('message-error', 'This user is already register');
                }
            } else {
                Session::flash('message-error', 'Field Empty');
            }
        }

        

        return Redirect::to('register');
    }
}
