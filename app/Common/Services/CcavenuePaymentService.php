<?php 
namespace App\Common\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\SiteSettingModel;
use App\Models\TransactionModel;
use App\Models\AddressesModel;
use App\Common\Services\MailService;

class CcavenuePaymentService
{
	public function __construct()
	{  
		$this->MailService = new MailService();
	}


	public function payment($arr_data = [])


	{

		if(isset($arr_data) && is_array($arr_data) && sizeof($arr_data)>0)
		{
			$arr_product_data = [];
			$arr_transaction  = [];
			$arr_user_data    = [];	
			$arr_address = [];
			$user_id          = $arr_data['user_id'];
			$order_id         = $arr_data['order_id'];
			$address_id       = $arr_data['address_id'];

			$obj_user_data = UserModel::where('id',$user_id)->first();
			$obj_address   = AddressesModel::where('id',$address_id)->first();
			
			if($obj_address)
			{
				$arr_address = $obj_address->toArray();
			}

			if($obj_user_data)
			{
				$arr_user_data = $obj_user_data->toArray();
			}
			
			if(isset($arr_data) && is_array($arr_data) && sizeof($arr_data)>0 && isset($arr_user_data) && is_array($arr_user_data) && sizeof($arr_user_data)>0)
			{
				$tracking_id   = $this->generate_tracking_id('12');
				$amount        = isset($arr_data['amount'])?$arr_data['amount']:'' ;
				$name          = isset($arr_user_data['first_name'])?$arr_user_data['first_name'].' '.$arr_user_data['last_name']:'';
				$address       = isset($arr_address['address'])?$arr_address['address']:$arr_user_data['address'];
				$city          = isset($arr_address['city'])?$arr_address['city']:$arr_user_data['city'];
				$state         = isset($arr_address['state'])?$arr_address['state']:$arr_user_data['state'];
				$zipcode       = isset($arr_address['post_code'])?$arr_address['post_code']:'';

				$country       = isset($arr_address['country'])?$arr_address['country']:$arr_user_data['country'];
				$mobile_number = isset($arr_user_data['order_contact_no'])?$arr_user_data['order_contact_no']:$arr_user_data['mobile_number'];
				$email_id      = isset($arr_user_data['order_email'])?$arr_user_data['order_email']:$arr_user_data['email'];
				$obj_currency  = SiteSettingModel::select('currency_rate')->first();

				$arr_transaction['tracking_id']    = $tracking_id;
				$arr_transaction['order_id']       = $order_id;
				$arr_transaction['amount']         = $amount;
				$arr_transaction['user_id']        = $user_id;
				$arr_transaction['payment_status'] = "0";
				$arr_transaction['order_status']   = '0';
				$arr_transaction['transaction_usd_value']   = $obj_currency->currency_rate;	

				$store_transaction = TransactionModel::create($arr_transaction);
				$store_transaction = 1;

				if($store_transaction==false)
				{   
					return Redirect::to(url('/').'/payment')->send()->with('error', 'Unknown error occurred');
				}

				$parameters = [
				'tid'             => $tracking_id,
				'order_id'        => $order_id,
				'amount'          => $amount,
				'billing_name'    => $name,
				'billing_address' => $address,
				'billing_city'    => $city,
				'billing_state'   => $state,
				'billing_zip'     => $zipcode,
				'billing_tel'     => $mobile_number,
				'billing_email'   => $email_id,
				'merchant_param2' => $arr_data['merchant_param2'],
				];

				return $parameters;
			}
			else
			{
				return false;
			} 
		}
		else
		{
			return false;
		}
			return false;
	}

	function update_transaction($arr_transaction=[])
	{
		$payment_status = "0";
		if(isset($arr_transaction) && is_array($arr_transaction) && sizeof($arr_transaction)>0)
		{
			$arr_trans_data = []; 

			if($arr_transaction['order_status']=="Success")
			{
				$payment_status = "1";
			}
			elseif($arr_transaction['order_status']=="Failure")
			{
				$payment_status = "2";
			}
			elseif($arr_transaction['order_status']=="Aborted")
			{
				$payment_status = "3";
			}
			elseif($arr_transaction['order_status']=="Invalid")
			{
				$payment_status = "4";
			}

			$order_id                           = isset($arr_transaction['order_id'])?$arr_transaction['order_id']:'';
			$arr_update_data['tracking_id']     = isset($arr_transaction['tracking_id'])?$arr_transaction['tracking_id']:'';
			$arr_update_data['order_id']        = isset($arr_transaction['order_id'])?$arr_transaction['order_id']:'';
			$arr_update_data['bank_ref_no']     = isset($arr_transaction['bank_ref_no'])?$arr_transaction['bank_ref_no']:'';
			$arr_update_data['order_status']    = isset($arr_transaction['order_status'])?$arr_transaction['order_status']:'';
			$arr_update_data['payment_status']  = $payment_status;
			$arr_update_data['card_name']       = isset($arr_transaction['card_name'])?$arr_transaction['card_name']:'';
			$arr_update_data['currency']        = isset($arr_transaction['currency'])?$arr_transaction['currency']:'';
			$arr_update_data['amount']          = isset($arr_transaction['amount'])?$arr_transaction['amount']:'';
			$arr_update_data['failure_message'] = isset($arr_transaction['failure_message'])?$arr_transaction['failure_message']:'';
			$arr_update_data['payment_mode']    = isset($arr_transaction['payment_mode'])?$arr_transaction['payment_mode']:'';
			$arr_update_data['status_code']     = isset($arr_transaction['status_code'])?$arr_transaction['status_code']:'';
			$arr_update_data['status_message']  = isset($arr_transaction['status_message'])?$arr_transaction['status_message']:'';
			$arr_update_data['currency']        = isset($arr_transaction['currency'])?$arr_transaction['currency']:'';
			$arr_update_data['billing_name']     = isset($arr_transaction['billing_name'])?$arr_transaction['billing_name']:'';
			$arr_update_data['billing_address']  = isset($arr_transaction['billing_address'])?$arr_transaction['billing_address']:'';
			$arr_update_data['billing_city']     = isset($arr_transaction['billing_city'])?$arr_transaction['billing_city']:'';
			$arr_update_data['billing_state']    = isset($arr_transaction['billing_state'])?$arr_transaction['billing_state']:'';
			$arr_update_data['billing_country']  = isset($arr_transaction['billing_country'])?$arr_transaction['billing_country']:'';
			$arr_update_data['billing_zip']      = isset($arr_transaction['billing_zip'])?$arr_transaction['billing_zip']:'';
			$arr_update_data['billing_email']    = isset($arr_transaction['billing_email'])?$arr_transaction['billing_email']:'';
			$arr_update_data['billing_tel']      = isset($arr_transaction['billing_tel'])?$arr_transaction['billing_tel']:'';
			$arr_update_data['delivery_name']    = isset($arr_transaction['delivery_name'])?$arr_transaction['delivery_name']:'';
			$arr_update_data['delivery_address'] = isset($arr_transaction['delivery_address'])?$arr_transaction['delivery_address']:'';
			$arr_update_data['delivery_city']    = isset($arr_transaction['delivery_city'])?$arr_transaction['delivery_city']:'';
			$arr_update_data['delivery_state']   = isset($arr_transaction['delivery_state'])?$arr_transaction['delivery_state']:'';
			$arr_update_data['delivery_zip']     = isset($arr_transaction['delivery_zip'])?$arr_transaction['delivery_zip']:'';
			$arr_update_data['delivery_country'] = isset($arr_transaction['delivery_country'])?$arr_transaction['delivery_country']:'';
			$arr_update_data['delivery_tel']     = isset($arr_transaction['delivery_tel'])?$arr_transaction['delivery_tel']:'';
			$arr_update_data['trans_date']       = isset($arr_transaction['trans_date'])?$arr_transaction['trans_date']:'';
			$arr_update_data['trans_type']       = '1';
			$arr_update_data['response_data']    = json_encode($arr_transaction);


			$update = TransactionModel::where('order_id',$order_id)->update($arr_update_data);

			/*get subscription details */


			/*$arr_email                 = [];
			$arr_email['full_name']    = isset($arr_transaction['billing_name'])?$arr_transaction['billing_name']:'Sir/Madam';
			$arr_email['product_name'] = isset($arr_product_data['product_name'])?$arr_product_data['product_name']:'';
			$arr_email['amount']       = isset($arr_transaction['amount'])?$arr_transaction['amount']:'0';
			$arr_email['email_id']     = isset($arr_transaction['billing_email'])?$arr_transaction['billing_email']:'';*/

			/*Send Invoice To User*/
			/*$send_email = $this->MailService->send_invoice($arr_email);*/
			return $payment_status;    
		}
		else
		{
			return false;
		}
	}

	function store_gift_card_transaction($arr_transaction=[])
	{
		$current_dollar_value = '';

		$date = date('Y-m-d H:i:s');

		$payment_status = "0";
		if(isset($arr_transaction) && is_array($arr_transaction) && sizeof($arr_transaction)>0)
		{
			$arr_trans_data = []; 

			if($arr_transaction['order_status']=="Success")
			{
				$payment_status = "1";
			}
			elseif($arr_transaction['order_status']=="Failure")
			{
				$payment_status = "2";
			}
			elseif($arr_transaction['order_status']=="Aborted")
			{
				$payment_status = "3";
			}
			elseif($arr_transaction['order_status']=="Invalid")
			{
				$payment_status = "4";
			}

			$current_dollar_value = get_current_dollar_value();

			

			$order_id                                  = isset($arr_transaction['order_id'])?$arr_transaction['order_id']:'';
			$arr_update_data['tracking_id']            = isset($arr_transaction['tracking_id'])?$arr_transaction['tracking_id']:'';
			$arr_update_data['order_id']               = isset($arr_transaction['order_id'])?$arr_transaction['order_id']:'';
			$arr_update_data['bank_ref_no']            = isset($arr_transaction['bank_ref_no'])?$arr_transaction['bank_ref_no']:'';
			$arr_update_data['order_status']           = isset($arr_transaction['order_status'])?$arr_transaction['order_status']:'';
			$arr_update_data['payment_status']         = $payment_status;
			$arr_update_data['card_name']              = isset($arr_transaction['card_name'])?$arr_transaction['card_name']:'';
			$arr_update_data['currency']               = isset($arr_transaction['currency'])?$arr_transaction['currency']:'';
			$arr_update_data['amount']                 = isset($arr_transaction['amount'])?$arr_transaction['amount']:'';
			$arr_update_data['failure_message']        = isset($arr_transaction['failure_message'])?$arr_transaction['failure_message']:'';
			$arr_update_data['payment_mode']           = isset($arr_transaction['payment_mode'])?$arr_transaction['payment_mode']:'';
			$arr_update_data['status_code']            = isset($arr_transaction['status_code'])?$arr_transaction['status_code']:'';
			$arr_update_data['status_message']         = isset($arr_transaction['status_message'])?$arr_transaction['status_message']:'';
			$arr_update_data['currency']               = isset($arr_transaction['currency'])?$arr_transaction['currency']:'';
			$arr_update_data['billing_name']           = isset($arr_transaction['billing_name'])?$arr_transaction['billing_name']:'';
			$arr_update_data['billing_address']        = isset($arr_transaction['billing_address'])?$arr_transaction['billing_address']:'';
			$arr_update_data['billing_city']           = isset($arr_transaction['billing_city'])?$arr_transaction['billing_city']:'';
			$arr_update_data['billing_state']          = isset($arr_transaction['billing_state'])?$arr_transaction['billing_state']:'';
			$arr_update_data['billing_country']        = isset($arr_transaction['billing_country'])?$arr_transaction['billing_country']:'';
			$arr_update_data['billing_zip']            = isset($arr_transaction['billing_zip'])?$arr_transaction['billing_zip']:'';
			$arr_update_data['billing_email']          = isset($arr_transaction['billing_email'])?$arr_transaction['billing_email']:'';
			$arr_update_data['billing_tel']            = isset($arr_transaction['billing_tel'])?$arr_transaction['billing_tel']:'';
			$arr_update_data['delivery_name']          = isset($arr_transaction['delivery_name'])?$arr_transaction['delivery_name']:'';
			$arr_update_data['delivery_address']       = isset($arr_transaction['delivery_address'])?$arr_transaction['delivery_address']:'';
			$arr_update_data['delivery_city']          = isset($arr_transaction['delivery_city'])?$arr_transaction['delivery_city']:'';
			$arr_update_data['delivery_state']         = isset($arr_transaction['delivery_state'])?$arr_transaction['delivery_state']:'';
			$arr_update_data['delivery_zip']           = isset($arr_transaction['delivery_zip'])?$arr_transaction['delivery_zip']:'';
			$arr_update_data['delivery_country']       = isset($arr_transaction['delivery_country'])?$arr_transaction['delivery_country']:'';
			$arr_update_data['delivery_tel']           = isset($arr_transaction['delivery_tel'])?$arr_transaction['delivery_tel']:'';
			$arr_update_data['trans_date']             = isset($arr_transaction['trans_date'])?$arr_transaction['trans_date']:'';
			$arr_update_data['trans_type']             = isset($arr_transaction['trans_type'])?$arr_transaction['trans_type']:'';
			$arr_update_data['transaction_usd_value']  = isset($current_dollar_value) ? $current_dollar_value : 0;
			$arr_update_data['user_gift_card_id']      = isset($arr_transaction['user_gift_card_id'])?$arr_transaction['user_gift_card_id']:'';
			$arr_update_data['user_id']                = isset($arr_transaction['user_id'])?$arr_transaction['user_id']:'';
			$arr_update_data['trans_date']             = $date;
			$arr_update_data['response_data']          = json_encode($arr_transaction);

			$store = TransactionModel::create($arr_update_data);
			
			return $payment_status;    
		}
		else
		{
			return false;
		}
	}

	public function generate_public_random_id()
	{
		$secure = TRUE;    
		$bytes = openssl_random_pseudo_bytes(8, $secure);
		$order_token = "CS-".date('Y').'-'.bin2hex($bytes);
		return $order_token;
	} 

	public function generate_tracking_id($length)
	{
		$result = '';
		for($i = 0; $i < $length; $i++) {
			$result .= mt_rand(0, 9);
		}

		return $result;
	}

	public function gift_card_payment($arr_data = [])
	{
		if(isset($arr_data) && is_array($arr_data) && sizeof($arr_data)>0)
		{
			$arr_product_data = [];
			$arr_transaction  = [];
			$arr_user_data    = [];	
			
			$user_id          = $arr_data['user_id'];

			$obj_user_data = UserModel::where('id',$user_id)->first();

			if($obj_user_data)
			{
				$arr_user_data = $obj_user_data->toArray();
			}
			if(isset($arr_data) && is_array($arr_data) && sizeof($arr_data)>0 && isset($arr_user_data) && is_array($arr_user_data) && sizeof($arr_user_data)>0)
			{
				
				$tracking_id   = $this->generate_tracking_id('12');
				$order_id      = $this->generate_public_random_id();
				$amount        = isset($arr_data['amount'])?$arr_data['amount']:'' ;
				$name          = isset($arr_user_data['first_name'])?$arr_user_data['first_name'].' '.$arr_user_data['last_name']:'';
				$address       = isset($arr_data['address'])?$arr_data['address']:'';
				$city          = isset($arr_data['city'])?$arr_data['city']:'';
				$state         = isset($arr_data['state'])?$arr_data['state']:'';
				$zipcode       = isset($arr_data['post_code'])?$arr_data['post_code']:'';
				
				$mobile_number = isset($arr_user_data['mobile_number'])?$arr_user_data['mobile_number']:'';
				$email_id      = isset($arr_user_data['email'])?$arr_user_data['email']:'';

				$arr_transaction['tracking_id']      = $tracking_id;
				$arr_transaction['order_id']         = $order_id;
				$arr_transaction['amount']           = $amount;
				$arr_transaction['user_id']          = $user_id;
				$arr_transaction['payment_status']   = "0";

				// $store_transaction = TransactionModel::create($arr_transaction);
				$store_transaction = 1;

				if($store_transaction==false)
				{   
					return Redirect::to(url('/').'/payment')->send()->with('error', 'Unknown error occurred');
				}

				$parameters = [
				'tid' =>  $tracking_id,
				'order_id' => $order_id,
				'amount' => $amount,
				'billing_name'=>$name,
				'billing_address'=>$address,
				'billing_city'=>$city,
				'billing_state'=>$state,
				'billing_zip'=>$zipcode,
				'billing_tel'=>$mobile_number,
				'billing_email'=>$email_id,
				'merchant_param2'=> 'gift_card'

				];
				/* $order = Indipay::prepare($parameters);
				return Indipay::process($order);*/
				return $parameters;
			}
			else
			{
				return false;
			} 
			
		}else
		{
			return false;
		}
	}



}