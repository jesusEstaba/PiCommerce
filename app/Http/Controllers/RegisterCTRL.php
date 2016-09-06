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
use Input;
use Pizza\Config;


class RegisterCTRL extends Controller
{
    /**
     * @return [type]
     */
    public function index ()
    {
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
            'publicApiKey' => env('API_GOOGLE_RECAPTCHA_PUBLIC'),
            'codes' => $codes,
            'streets' => $streets,
            'termsAndServices' => $termsAndServices,
        ]);
    }


    /**
     * @param  Request
     * @return [type]
     */
    public function register (Request $request)
    {
        $json = $this->reCaptcha($request['g-recaptcha-response']);

        if ($json['success'] || env('APP_ENV')=='local') {
            $validator = $this->validatorRules($request);

            if ($validator->fails()==0) {
                $datos = DB::table('users')
                    ->where('email', $request['email'])
                    ->select('users.id')
                    ->get();

                $datosPhone = DB::table('customers')
                    ->where('Cs_Phone', $request['phone'])
                    ->select('Cs_Phone')
                    ->get();

                if (!$datos && !$datosPhone) {
                    
                    $distance = $this->distance(
                        $request['latitude'], 
                        $request['longitude']
                    );

                    $distance = ($distance['calc']) ? $distance['val'] : '';

                    $rangeDelivery = Config::value1('Maximum Range Delivery');

                    $extra = [];

                    if ($rangeDelivery) {
                        if ($distance > $rangeDelivery) {
                            $extra = [
                                'warning' => Config::message('Maximum Range Delivery'),
                            ];
                        }
                    }

                    $errorToSend = $this->sendEmailToNewUser(
                        $request['email'],
                        $request['name'],
                        $request['password'],
                        $extra
                    );

                    if ($errorToSend===0) {
                        $receive = ($request['offers']) ? 1 : 0;

                        DB::table('users')->insert([
                            'password' => bcrypt($request['password']),
                            'email' => $request['email'],
                            'phone'=> $request['phone'],
                            'receive_offers' => $receive,
                        ]);
                       
                        $birthdayCustomer = $this->birthday($request->only([
                            'month_birthday',
                            'day_birthday',
                            'year_birthday',
                        ]));

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
                            'Cs_Distance' => $distance,
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
                    if ($datosPhone && $datos) {
                        $messageUsedData = 'This email and phone has already been used';
                    } elseif ($datosPhone) {
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


    /**
     *  Devuelve la destancia en kilometros de la ubicaion del cliente
     *  y el restaurante
     *  
     *  @return array [calc true => devuelve ['value'] que tiene la distancia, false => no se pudo calcular]
     */
    protected function distance($latilude, $longitude)
    {
        $response = ['calc' => false];

        if ($latilude && $longitude) {
            $origen = $latilude . ',' . $longitude;
            
            $coord = Config::message('Coordinates');

            $destino = ($coord) ? $coord : '9.779808,-63.196956';


            $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?'
            .'origins=' . $origen
            .'&destinations=' . $destino
            .'&key=' . env('API_GOOGLE_MAPS_DISTANCE', '');

            $respJson = $this->jsonCallOuter($url);

            if ($respJson['status'] == "OK") {
                $respuesta = $respJson['rows'][0]['elements'][0];
                
                if ($respuesta['status'] == "OK") {
                    $distance = (float) $respuesta['distance']['value'];
                    $distance /= 1000;// conversion a kilometros

                    $response = [
                        'calc' => true,
                        'val' => $distance,
                    ];
                }
            }
        }

        return $response;
    }


    /**
     * @param  [type]
     * @return [type]
     */
    protected function reCaptcha ($reCaptchaResponse)
    {
        $secretKey = env('API_GOOGLE_RECAPTCHA', '');
        $gReCaptcha = $reCaptchaResponse;

        $url = 'https://www.google.com/recaptcha/api/siteverify'.
        '?secret=' . $secretKey .
        '&response=' . $gReCaptcha;

        return $this->jsonCallOuter($url);
    }


    /**
     * @param  [type]
     * @return [type]
     */
    protected function jsonCallOuter ($url)
    {
        $jsonObj = file_get_contents($url);
        return json_decode($jsonObj, true);
    }


    /**
     * @param  [type]
     * @return [type]
     */
    protected function validatorRules ($request)
    {
        $rules = [
                'password' => 'required|min:6',
                'email' => 'required|email',
                'phone' => 'required|numeric|digits:10',
                'name' => 'required',
                'street_number' => 'required',
                'zip_code' => 'required|numeric|integer',
                'street_name' => 'required',
            ];

        return Validator::make($request->all(), $rules);
    }

    /**
     * @param  [type]
     * @param  [type]
     * @param  [type]
     * @param  array
     * @return [type]
     */
    protected function sendEmailToNewUser($userMail, $name, $pass, $extras=[])
    {
        $logo = Config::message('logo');
        $footer = Config::message('footer');
        $messageRegister = Config::message('Register Message');

        $day = Carbon::now();
        
        $token_active = md5($userMail . $day . rand());

        $variables_correo = [
            'messageRegister' => $messageRegister,
            'logo' => $logo,
            'footer'=> $footer,
            'title'=>'Active Your Account',
            'name' => $name,
            'pass' => $pass,
        ];

        if (count($extras)) {
            $variables_correo = array_merge($variables_correo, $extras);
        }        

        $isErrorEmail = SendMailCTRL::sendNow(
            'mail_template.new_user',
            $variables_correo,
            $userMail,
            'Reset Password'
        );

        return $isErrorEmail;
    }


    protected function birthday ($request) 
    {
        $month = (int)$request['month_birthday'];
        $day = (int)$request['day_birthday'];
        $year = (int)$request['year_birthday'];

        if ($month && $day && $year) {
            return Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
        } else {
            return '';
        }
    }
}
