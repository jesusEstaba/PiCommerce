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
				"TranType" => $request["TranType"],
				"TranCode" => $request["TranCode"],
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
		
		if ($requestData["TranType"] == "PrePaid") {
			$responseData = $soapHelper->gift_transaction($requestData, $_REQUEST["Password"]);
		} else {
			// Add Token request keys for Credit Transactions
			$requestData["Frequency"] = "OneTime";
			$responseData = $soapHelper->credit_transaction($requestData, $_REQUEST["Password"]);
		}

		return view('paytestresult')->with([
			'requestData' => $requestData,
			'responseData' => $responseData,
		]);
    }
}
