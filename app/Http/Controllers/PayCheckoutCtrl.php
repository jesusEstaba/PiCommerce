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
		// STEP 1: Build the request array
		$requestData = [
				"MerchantID" => $request["MerchantID"],
				"LaneID" => '02',
				"TranType" => $request["TranType"],//Credit
				"TranCode" => $request["TranCode"],//Sale
				"InvoiceNo" => $request["InvoiceNo"],
				"RefNo" => $request["RefNo"],
				"AcctNo" => $request["AcctNo"],
				"ExpDate" => $request["ExpDate"],
				"Memo" => $request["Memo"],
				"Purchase" => $request["Purchase"]
		];

		// STEP 2: Use helper class to process the MercuryGift Web Services transaction
		//include_once("Mercury_Web_Services_SOAP_Helper.php");//no includ... because... laravel...
		
		$soapHelper = new PayMercuryCtrl();
		
		/*
		if ($requestData["TranType"] == "PrePaid") {
			$responseData = $soapHelper->gift_transaction($requestData, $_REQUEST["Password"]);
		} else {
			// Add Token request keys for Credit Transactions
			$requestData["Frequency"] = "OneTime";
			$responseData = $soapHelper->credit_transaction($requestData, $_REQUEST["Password"]);
		}
		*/
		//$soapHelper->credit_transaction($requestData, 'lalala');

		$dataPayment = [
			'MerchantID' => '778825001',
			'LaneID' => '02',
			'Password' => '$6a!a#aa.DHWgD9L',
			'Invoice' => '54321',
			'TotalAmount' => 9.9,
			'TaxAmount' => 0.0,
			'TranType' => 'PreAuth',
			'Frequency' => 'OneTime',
			'Memo' => 'InitializePaymentTest',
			'ProcessCompleteUrl' => 'http://www.mercurypay.com',
			'ReturnUrl' => 'http://www.mercurypay.com'
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

		echo '<form action="https://hc.mercurycert.net/mobile/mCheckout.aspx" method="post">
		<input name="PaymentID" type="hidden" value="' . $paymentid . '"\>
	
		<input type="submit" value="checkout"/>

		</form>';
		
		return ;
    }
}
