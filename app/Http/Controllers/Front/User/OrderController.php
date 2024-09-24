<?php
namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\OrderService;
use App\Common\Services\WalletService;
use App\Common\Services\GiftCardService;
use App\Common\Services\MailService;
use App\Common\Services\NotificationService;
use App\Common\Services\CcavenuePaymentService;
use App\Common\Services\CartService;
use App\Models\ShoppingCartModel;
use App\Models\CartProductModel;
use App\Models\AddressesModel;
use App\Models\BankDetailsModel;
use App\Models\SiteSettingModel;
use App\Models\TransactionModel;
use App\Models\OrdersModel;

use Indipay;
use Validator;

class OrderController extends Controller
{

	function __construct(
		MailService            $mail_service,
		CartService            $cart_service,
		OrderService           $orderservice,
		WalletService          $wallet_service,
		AddressesModel         $addresses_model,
		GiftCardService        $gift_card_service,
		BankDetailsModel       $bank_details_model,
		CartProductModel       $cart_product_model,
		SiteSettingModel       $site_setting_model,
		ShoppingCartModel      $shopping_cart_model,
		NotificationService    $notification_service,
		CcavenuePaymentService $ccavenue_payment_service,
		TransactionModel $transaction_model
		)
	{
		$this->arr_view_data          = [];
		$this->module_url_path        = url('/order');
		$this->CartService            = $cart_service;
		$this->OrderService           = $orderservice;
		$this->MailService            = $mail_service;
		$this->WalletService          = $wallet_service;
		$this->AddressesModel         = $addresses_model;
		$this->module_view_folder     = 'front.user.order';
		$this->GiftCardService        = $gift_card_service;
		$this->CartProductModel       = $cart_product_model;
		$this->BankDetailsModel       = $bank_details_model;
		$this->SiteSettingModel       = $site_setting_model;
		$this->ShoppingCartModel      = $shopping_cart_model;
		$this->NotificationService    = $notification_service;
		$this->CcavenuePaymentService = $ccavenue_payment_service;
		$this->TransactionModel       = $transaction_model;

		$this->product_image_base_path = base_path().config('app.project.img_path.product_images');
	}

	public function order_details(Request $request)
	{
		$arr_cart_product = [];
		$arr_addresses    = [];
		$arr_bank_details = [];
		
		$user_id      = login_user_id('user');
		$wallet_total = wallet_total($user_id);
		$count        = get_cart_count();

		if($count<=0)
		{
			return redirect()->back();
		}

		$obj_cart         = $this->ShoppingCartModel->where('user_id', $user_id)->select('id')->first();

		if($obj_cart)
		{
			$obj_cart_product = $this->CartProductModel
			->with(['product_details'=>function($q)
			{
				$q->select(['id','product_name','final_price','product_code']);
			}
			])
			->with(['product_image'=>function($q){
				$q->select('product_id','image');
			}])
			->with(['size_details'=>function($q){
				$q->select(['id','size_name']);
			}])
			->where('cart_id',$obj_cart->id)->get(['id','cart_id','product_id','product_size_id','product_quantity']);

			if($obj_cart_product)
			{
				$arr_cart_product = $obj_cart_product->toArray();
			}
		}

		$obj_addresses = $this->AddressesModel
		->where('user_id',$user_id)
		->get(['id','flat_no', 'building_name', 'address', 'city', 'post_code','state','country', 'default_address']);

		if($obj_addresses)
		{
			$arr_addresses = $obj_addresses->toArray();
		}

		$obj_bank_details = $this->BankDetailsModel->where('user_type', '=', '1')->select("account_holder_name", "bank_name", "branch", "account_number", "ifsc_code")->first();

		if($obj_bank_details)
		{
			$arr_bank_details = $obj_bank_details->toArray();
		}

		$this->arr_view_data['arr_addresses']           = $arr_addresses;
		$this->arr_view_data['arr_country_codes']       = get_phonecode();
		$this->arr_view_data['wallet_total']            = wallet_total($user_id);
		$this->arr_view_data['arr_bank_details']        = $arr_bank_details;
		$this->arr_view_data['product_image_base_path'] = $this->product_image_base_path;
		$this->arr_view_data['arr_cart_product']        = $arr_cart_product;
		$this->arr_view_data['parent_module_title']     = 'Order';
		$this->arr_view_data['module_title']            = 'Order Details';
		$this->arr_view_data['parent_module_url']       = $this->module_url_path.'/order_details';
		$this->arr_view_data['module_url_path']         = $this->module_url_path;
		$this->arr_view_data['page_title']              = 'Order Details';

		if($request->ajax()) 
		{
			return view($this->module_view_folder.'.ajax_order_details',$this->arr_view_data)->render();
		}

		return view($this->module_view_folder.'.order_details',$this->arr_view_data);
	}

	public function get_address($id=null)
	{
		if($id!=null)
		{
			$id = base64_decode($id);
			$obj_address = $this->AddressesModel
			->where('id',$id)
			->select(['flat_no', 'building_name', 'address', 'city', 'post_code','state','country'])->first();

			if($obj_address)
			{
				$arr_address = $obj_address->toArray();
				$arr_data['address'] = $arr_address;
				$arr_data['status'] = 'success';
				return $arr_data;
			}

			$arr_data['status'] = 'error';
			return $arr_data;
		}

		$arr_data['status'] = 'error';
		return $arr_data;
	}

	public function delete_address($id=null)
	{
		if($id!=null)
		{
			$id = base64_decode($id);
			$obj_address = $this->AddressesModel
			->where('id',$id)
			->delete();

			if($obj_address)
			{
				$arr_data['status'] = 'success';
				return $arr_data;
			}

			$arr_data['status'] = 'error';
			return $arr_data;
		}

		$arr_data['status'] = 'error';
		return $arr_data;
	}

	public function update_address(Request $request)
	{
		$arr_response = [];
		$arr_rules    = array();

		$arr_rules['el']           = "required";
		$arr_rules['flatnumber']   = "required";
		$arr_rules['buildingname'] = "required";
		$arr_rules['address']      = "required";
		$arr_rules['city']         = "required";
		$arr_rules['state']        = "required";
		$arr_rules['country']      = "required";
		$arr_rules['postcode']     = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails())
		{       
			$arr_response['status'] = 'error';
			return $arr_response;
		}

		$arr_data['flat_no']       = $request->input('flatnumber',null);
		$arr_data['building_name'] = $request->input('buildingname', null);
		$arr_data['address']       = $request->input('address', null);
		$arr_data['city']          = $request->input('city', null);
		$arr_data['post_code']     = $request->input('postcode', null);
		$arr_data['state']         = $request->input('state', null);
		$arr_data['country']       = $request->input('country', null);

		$id     = base64_decode($request->input('el'));
		$status = $this->AddressesModel->where('id',$id)->update($arr_data);

		$arr_response['status'] = 'success';
		return $arr_response;
	}

	public function add_address(Request $request)
	{
		$arr_response = [];
		$arr_rules    = array();

		$arr_rules['flatnumber']   = "required";
		$arr_rules['buildingname'] = "required";
		$arr_rules['address']      = "required";
		$arr_rules['city']         = "required";
		$arr_rules['state']        = "required";
		$arr_rules['country']      = "required";
		$arr_rules['postcode']     = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails())
		{       
			$arr_response['status'] = 'error';
			return $arr_response;
		}
		$arr_data['user_id']       = login_user_id('user');
		$arr_data['flat_no']       = $request->input('flatnumber',null);
		$arr_data['building_name'] = $request->input('buildingname', null);
		$arr_data['address']       = $request->input('address', null);
		$arr_data['city']          = $request->input('city', null);
		$arr_data['post_code']     = $request->input('postcode', null);
		$arr_data['state']         = $request->input('state', null);
		$arr_data['country']       = $request->input('country', null);

		$status = $this->AddressesModel->create($arr_data);

		$arr_response['status'] = 'success';
		return $arr_response;
	}

	public function place_order(Request $request)
	{
		$arr_rules    = array();
		$order_cost   = 0;
		$user_id      = login_user_id('user');
		$wallet_total = wallet_total($user_id);

		$arr_rules['firstname']      = "required";
		$arr_rules['lastname']       = "required";
		$arr_rules['emailaddress']   = "required";
		$arr_rules['mobilemunber']   = "required";
		$arr_rules['address']        = "required";
		$arr_rules['payment_option'] = "required";


		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails())
		{       
			return redirect()->back()->withErrors($validator)->withInput();  
		}

		$arr_address      = [];
		$order_id         = $this->generate_order_id();
		$obj_site_setting = $this->SiteSettingModel->select('currency_rate','product_return_days')->first();
		$date             = strtotime("+".$obj_site_setting->product_return_days." day");

		$order_cost = get_cart_subtotal()+get_cart_total_insurance();

		$apply_wallet = $request->input('apply_wallet',null);

		$arr_data['status']               = '0';
		$arr_data['order_id']             = $order_id;
		$arr_data['order_return_date']    = date('c',$date);
		$arr_data['user_id']              = $user_id;
		$arr_data['address_id']           = base64_decode($request->input('address'));
		$arr_data['order_fname']          = $request->input('firstname',null);
		$arr_data['order_lname']          = $request->input('lastname',null);
		$arr_data['order_email']          = $request->input('emailaddress',null);
		$arr_data['order_contact_no']     = "+".$request->input('country_code','').$request->input('mobilemunber','');
		$arr_data['order_payment_method'] = $request->input('payment_option','1');
		$arr_data['order_subtotal']       = get_cart_subtotal();
		$arr_data['order_cost']           = $order_cost;
		$arr_data['order_usd_value']      = isset($obj_site_setting->currency_rate)? $obj_site_setting->currency_rate: '0';
		
		$obj_address                 = $this->AddressesModel->where('id', $arr_data['address_id'])->first();
		$arr_data['order_base_cost'] = $order_cost-get_cart_total_discount();


		if($obj_address)
		{
			$arr_address                     = $obj_address->toArray();
			$arr_data['order_flat_no']       = $arr_address['flat_no'];
			$arr_data['order_building_name'] = $arr_address['building_name'];
			$arr_data['order_address']       = $arr_address['address'];
			$arr_data['order_city']          = $arr_address['city'];
			$arr_data['order_post_code']     = $arr_address['post_code'];
			$arr_data['order_state']         = $arr_address['state'];
			$arr_data['order_country']       = $arr_address['country'];

		}
		$order_status = $this->OrderService->create($arr_data);

		if($order_status)
		{
			$order_cost = $order_status->order_cost;
			// $order_cost = $order_cost-$wallet_total;

			if($apply_wallet=='yes' && $arr_data['order_payment_method']==1)
			{

				if(($wallet_total*1.5) < $order_cost)
				{
					$arr_wallet['user_id']              = $user_id;
					$arr_wallet['total_wallet_balance'] = $wallet_total;
					$arr_wallet['used_wallet_balance']  = $wallet_total;
					$arr_wallet['order_id']             = $order_status->order_id;
					$apply_wallet                       = $this->WalletService->apply_wallet($arr_wallet);
					$order_cost = $order_cost-$wallet_total;
				}
			}
			$arr_payment['user_id']          = $user_id;
			$arr_payment['order_id']         = $order_id;
			$arr_payment['merchant_param2']  = 'product';
			$arr_payment['amount']           = $order_cost-get_cart_giftcard_discount();
			$arr_payment['address_id']       = $arr_data['address_id'];
			$arr_payment['order_fname']      = $arr_data['order_fname'];
			$arr_payment['order_lname']      = $arr_data['order_lname'];
			$arr_payment['order_email']      = $arr_data['order_email'];
			$arr_payment['order_contact_no'] = $arr_data['order_contact_no'];

			$parameters = $this->CcavenuePaymentService->payment($arr_payment);

			if($arr_data['order_payment_method']==1)
			{
				$order = Indipay::prepare($parameters);
				return Indipay::process($order);
			}

			$arr_wallet['order_mobile'] = $arr_data['order_contact_no'];
			$arr_wallet['user_id']      = $user_id;
			$arr_wallet['order_id']     = $order_id;
			$arr_wallet['order_status'] = 'Success';

			$wallet_status   = $this->WalletService->update_wallet($arr_wallet);
			$giftcard_status = $this->GiftCardService->update_giftcard($arr_wallet);
			$email_data      = $this->OrderService->get_order_email_details($order_id);
			$send_email      = $this->MailService->order_send_mail($email_data);
			$send_email      = $this->NotificationService->new_order_notification($arr_wallet);
			$empty_cart      = $this->CartService->empty_cart($user_id);
			$tracking_id     = $this->generate_tracking_id('12');

			$update_transaction = $this->TransactionModel->where('order_id', $order_id)->update(['payment_status'=>'5', 'tracking_id'=>$tracking_id]);

			return redirect(url('order/success'));
		}
		return redirect(url('payment/error'));
	}

	public function order_success()
	{
		$this->arr_view_data['page_title'] = 'Order Success';
		return view($this->module_view_folder.'.success',$this->arr_view_data);
	}

	public function generate_order_id()
	{
		$result = 'AM-';
		
		for($i = 0; $i < 10; $i++) 
		{
			$result .= mt_rand(0, 9);
		}

		$count = OrdersModel::where('order_id', $result)->count();
		
		if($count!='0')
		{
			$this->generate_order_id();
		}

		return $result;
	} 

	public function generate_tracking_id($length)
	{
		$result = '';
		for($i = 0; $i < $length; $i++) {
			$result .= mt_rand(0, 9);
		}

		return $result;
	}
}

