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
     * 
     */
    protected $url;


	function __construct()
	{
		$this->url = (env('MERCURY_PRODUCTION', false)) ? 'pay.com' : 'cert.net';

		$this->wsClient = new SoapClient('https://hc.mercury' . $this->url . '/hcws/HCService.asmx?WSDL');
	}


	/**
	 * 
	 */
	public function InitializePayment(array $paramsDataPayment)
	{
		$finalData = array_merge(
			[
				'MerchantID' => env('MERCURY_MERCHANT_ID', ''),
	            'Password' => env('MERCURY_MERCHANT_PASSWORD', ''),
			],
			$paramsDataPayment 
		);

		$initPaymentRequest = ['request' => $finalData];

		return $this->wsClient->InitializePayment($initPaymentRequest)->InitializePaymentResult;
	}


	/**
	 * 
	 */
	public function VerifyPayment(array $paramsDataPayment)
	{
		$finalData = array_merge(
			[
				'MerchantID' => env('MERCURY_MERCHANT_ID', ''),
	            'Password' => env('MERCURY_MERCHANT_PASSWORD', ''),
			],
			$paramsDataPayment 
		);

		$initPaymentRequest = ['request' => $finalData];
		
		return $this->wsClient->VerifyPayment($initPaymentRequest)->VerifyPaymentResult;
	}


	/**
	 * 
	 */
	public function urlCheckout($type = 'web')
	{
		if ($type == 'mobile') {
			return 'https://hc.mercury' . $this->url . '/mobile/mCheckout.aspx';
		}

		return 'https://hc.mercury' . $this->url . '/Checkout.aspx';
	}
}
