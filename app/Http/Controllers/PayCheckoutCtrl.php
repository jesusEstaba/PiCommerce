<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

class PayCheckoutCtrl extends Controller
{

    public function index()
    {
    	return view('paytestindex');
    }


    public function transaction(Request $request)
    {
    	/*
		$soapHelper = new PayMercuryCtrl();
		
		$dataPayment = [
			'MerchantID' => '778825001',
			#'LaneID' => '02',
			'Password' => '$6a!a#aa.DHWgD9L',
			'Invoice' => '54321',//Id Order
			'TotalAmount' => $request["Purchase"],
			'TaxAmount' => 0.0,
			'TranType' => 'Sale',
			'Frequency' => 'OneTime',
			'Memo' => $request["Memo"],
			'ProcessCompleteUrl' => url('/create-pay'),
			'ReturnUrl' => url('/create-pay'),
		];
		
		$initPaymentResponse = $soapHelper->InitializePayment($dataPayment);





		//////////////////////////////////////EXTRAS///////////////////////////////////////

		echo "<pre>";
		echo "<h1>InitializePayment Example</h1>";
		echo "Response Code: " . $initPaymentResponse->InitializePaymentResult->ResponseCode;
		echo "<br />Message: " . $initPaymentResponse->InitializePaymentResult->Message;
		echo "<br /><h3>Request:</h3>";
		
		print_r($dataPayment);
		echo "<br /><h3>Response:</h3>";
		
		
		print_r($initPaymentResponse);
		echo "</pre>";
		
		$paymentid = $initPaymentResponse->InitializePaymentResult->PaymentID;

		echo "PaymentID:" . $paymentid;// Hide PaymentID from 

		echo '<form action="https://hc.mercurycert.net/Checkout.aspx" method="post">
		<input name="PaymentID" type="hidden" value="' . $paymentid . '"\>

		<input name="ReturnMethod" type="hidden" value="GET"\>
		
		<input type="submit" value="checkout"/>

		</form>';
		*/
		
		return view('verifyPayment')->with([
			'PaymentID' => $request['PaymentID'],
			'ReturnCode' => $request['ReturnCode'],
			'ReturnMessage' => $request['ReturnMessage'],
		]);
    }
}
