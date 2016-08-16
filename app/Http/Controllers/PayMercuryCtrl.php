<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use SoapClient;
use SimpleXMLElement;

class PayMercuryCtrl extends Controller
{
	/**
	 * Mercury Certification WSDL
	 */

	/**
	 * 
	 */
    protected $wsClient;


    /**
     * @param bool $production [para indicar si esta en produccion]
     */
	function __construct($production = false)
	{
		$wsdlURL = ($production) ? 'pay.com' : 'cert.net';
		
		$this->wsClient = new SoapClient('https://hc.mercury' . $wsdlURL . '/hcws/HCService.asmx?WSDL');
	}


	/**
	 * 
	 */
	public function InitializePayment(array $paramsDataPayment)
	{
		$initPaymentRequest = ['request' => $paramsDataPayment];

		return $this->wsClient->InitializePayment($initPaymentRequest)->InitializePaymentResult;
	}


	/**
	 * 
	 */
	public function VerifyPayment(array $paramsDataPayment)
	{
		$initPaymentRequest = ['request' => $paramsDataPayment];

		return $this->wsClient->VerifyPayment($initPaymentRequest)->VerifyPaymentResult;
	}
}
