<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Pizza\User;
use Session;
use DB;
use Validator;
use Carbon\Carbon;

class RegisterCTRL extends Controller
{
    public function index()
    {
        /*
        $codes = DB::select('SELECT * from street where St_City = ?', ['Orlando']);
        $streets = DB::select('SELECT distinct St_ZipCode from street');
        */
        $codes = DB::table('street')
            ->select('St_Name')
            ->get();

        $streets = DB::table('street')
            ->distinct()
            ->select('St_ZipCode')
            ->get();

        $termsAndServices = DB::table('terms_service')
            ->where('section', 1)
            ->first();

        if ($termsAndServices) {
            $termsAndServices = $termsAndServices->terms;
        } else {
            $termsAndServices = '';
        }

        return view('register')->with([
            'codes' => $codes,
            'streets' => $streets,
            'termsAndServices' => $termsAndServices,
            ]);
    }

    public function register(Request $request)
    {
        $secretKey = '6LdrFB0TAAAAAGKvs-WNMXulyCbpB81xFaM0jj5k';
        $gReCaptcha = $request['g-recaptcha-response'];

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$gReCaptcha;
        $jsonObj = file_get_contents($url);
        $json = json_decode($jsonObj, true);

        if ($json['success']) {
            $rules = [
                'password' => 'required|min:6',
                'email' => 'required|email',
                'phone' => 'required|numeric|digits:10',
                'name' => 'required',
                'street_number' => 'required',
                'zip_code' => 'required|numeric|integer',
                'street_name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()==0) {
                $datos = DB::table('users')
                    ->where('email', $request['email'])
                    ->select('users.id')
                    ->get();

                $datos_phone = DB::table('customers')
                    ->where('Cs_Phone', $request['phone'])
                    ->select('Cs_Phone')
                    ->get();

                if (!$datos && !$datos_phone) {
                    $errorToSend = ResetPasswordCTRL::sendEmailToNewUser(
                        $request['email'],
                        $request['name'],
                        $request['password']
                    );

                    if ($errorToSend===0) {
                        DB::table('users')->insert([
                            'password' => bcrypt($request['password']),
                            'email' => $request['email'],
                            'phone'=> $request['phone'],
                        ]);

                        if (!empty($request['day_birthday']) &&
                            !empty($request['month_birthday']) &&
                            !empty($request['year_birthday'])
                        ) {
                            $yearBirthday = (int) $request['year_birthday'];
                            $monthBirthday = (int) $request['month_birthday'];
                            $dayBirthday = (int) $request['day_birthday'];

                            $birthdayCustomer = Carbon::createFromDate(
                                $yearBirthday,
                                $monthBirthday,
                                $dayBirthday
                            );
                        } else {
                            $birthdayCustomer = '.';
                        }

                        DB::table('customers')->insert([
                            'Cs_Email1' => $request['email'],
                            'Cs_Phone'=> $request['phone'],
                            'Cs_Name' => $request['name'],
                            'Cs_Company' => $request['company'],
                            'Cs_Number' => $request['street_number'],
                            'Cs_Street' => $request['street_name'],
                            'Cs_Date' => Carbon::now(),
                            'Cs_Ap_Suite' => $request['aparment'],
                            'Cs_ZipCode' => $request['zip_code'],
                            'Cs_Notes' => $request['special_directions'],
                            'Cs_Birthday'=>$birthdayCustomer,
                            /*
                            '' => $request['aparment_complex'],
                            '' => $request['city'],
                            */
                           'Cs_Building' => '.',
                            'Cs_StreetPost' => '.',
                            'Cs_Across' => '.',
                            'Cs_NC' => '.',
                            'Cs_Gates' => '.',
                            'Cs_Email2'=>'.',
                            'Cs_Status' => 0,
                            'Cs_Tax' => 0,
                            'Cs_Mail' => 0,
                        ]);

                        return redirect()->to('active-your-acount');
                    } else {
                        Session::flash('message-error', 'Failed to create user.');
                    }
                } else {
                    if ($datos_phone && $datos) {
                        $messageUsedData = 'This email and phone has already been used';
                    } elseif ($datos_phone) {
                        $messageUsedData = 'This phone has already been used.';
                    } else {
                        $messageUsedData = 'This email has already been used.';
                    }

                    Session::flash('message-error', $messageUsedData);
                }
            } else {
                $validationErros = '';

                $validtr = $validator->messages()->toArray();

                foreach ($validtr as $key => $value) {
                     $validationErros .= $value[0].'<br>';
                }

                Session::flash('message-error', $validationErros);
            }
        } else {
            Session::flash('message-error', 'Invalid reCAPTCHA.');
        }

        return redirect()->back()->withInput($request->except('password'));;
    }
}
