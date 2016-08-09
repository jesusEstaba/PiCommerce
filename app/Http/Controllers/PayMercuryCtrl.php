<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

class PayMercuryCtrl extends Controller
{
    private $wsClient;

	function __construct()
	{
		// Mercury Certification WSDL
		//ini_set("soap.wsdl_cache_enabled","0");
		$wsdlURL = "https://w1.mercurycert.net/ws/ws.asmx?WSDL";
		$this->wsClient = new \SoapClient($wsdlURL);
	}

	private function array_to_xml(array $arr, $xml)
	{
		foreach ($arr as $k => $v) {
			is_array($v) ? array_to_xml($v, $xml) : $xml->children()->addChild($k, $v);
		}

		return $xml->asXML();
	}

	private function array_flat(array $complexArray, array &$flatArray)
	{
		foreach ($complexArray as $key => $value) {
			if (is_array($value)){
				$flatArray = array_merge($flatArray, $this->array_flat($value, $flatArray));
			} else {
				$flatArray[$key] = $value;
			}
		}

		return $flatArray;
	}

	public function credit_transaction(array $requestData, $password)
	{
		$tStream = new \SimpleXMLElement('<TStream/>');
		$secondElement = "Transaction";

		if (isset($requestData["TranCode"])) {
			switch (strtolower($requestData["TranCode"]))
			{
				case "batchsummary":
				case "itemdetail":
				case "batchclear":
				case "batchclose":
				case "serverversion":
				case "keychange":
					$secondElement = "Admin";
					break;
			}
		}

		$tStream->addChild($secondElement);

		$xmlRequest = $this->array_to_xml($requestData, $tStream);

		$clientRequest = array(
				"tran"	=>	$xmlRequest,
				"pw"	=>	$password,
		);

		$xmlResponse = $this->wsClient->CreditTransaction($clientRequest)->CreditTransactionResult;
		
		return $this->arrayConvert($xmlResponse);
	}

	public function gift_transaction(array $requestData, $password)
	{
		// IpPort required for Gift Transactions
		$requestData["IpPort"] = "9100";

		$tStream = new \SimpleXMLElement('<TStream/>');
		$tStream->addChild("Transaction");

 		$xmlRequest = $this->array_to_xml($requestData, $tStream);

 		$clientRequest = [
 			"tran"	=>	$xmlRequest,
 			"pw"	=>	$password,
 		];

    	var_dump($clientRequest);
 		
 		$xmlResponse = $this->wsClient->GiftTransaction($clientRequest)->GiftTransactionResult;

		return $this->arrayConvert($xmlResponse);
	}

	public function arrayConvert($xmlResponse)
	{
		$complexArray = json_decode(json_encode((array) simplexml_load_string($xmlResponse)),1);
 		$flatArray = array();
 		$flatArray = $this->array_flat($complexArray, $flatArray);
 		
 		return $flatArray;
	}
}
