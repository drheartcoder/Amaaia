<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\OtpService;
use App\Common\Services\CcavenuePaymentService;
use App\Common\Services\OrderService;
use Indipay;
use Session;

class DemoController extends Controller
{
	public function __construct(OtpService $otp_service, CcavenuePaymentService $ccavenue_payment_service,OrderService $order_service)
	{
		$this->OtpService = $otp_service;
		$this->OrderService = $order_service;
		$this->CcavenuePaymentService = $ccavenue_payment_service;
	}
	public function send_otp(){
		$arr_data['phone_code']  = '+91';
		$arr_data['mobile_no']   = '9921840141';
		$arr_data['user_id']     = '2';
		$arr_data['template_id'] = '7';
		dd($this->OtpService->send_otp($arr_data));

	}

	public function payment()
	{
		$parameters = $this->CcavenuePaymentService->payment(array('amount'=>'400','user_id'=>'3','product_id'=>'1'));
		              $order = Indipay::prepare($parameters);
              return Indipay::process($order);
	}

	public function AddSession(Request $request)
	{
		$sess = $request->except('_token');
		// $request->session()->put('product_details', $sess);
	}

	public function order(Request $request, $order_id)
	{
		$this->OrderService->get_order_email_details($order_id);
// dd($order_id);
	}

}
