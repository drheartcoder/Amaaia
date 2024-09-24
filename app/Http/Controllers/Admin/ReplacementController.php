<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ReplacementProductRequestModel;
use App\Models\OrdersProductModel;
use App\Models\UserWalletModel;
use App\Models\TransactionModel;

use App\Common\Services\NotificationService;
use App\Common\Services\SmsService;

use DataTables;
use Session;
use Validator;



class ReplacementController extends Controller
{
    public function __construct(
    							ReplacementProductRequestModel $replacement_product_requestmodel,
    							OrdersProductModel             $order_product,
    							NotificationService            $notification_service,
    							SmsService                     $sms_service,
    							UserWalletModel                $user_wallet_model,
    							TransactionModel               $transaction
    						)
	{
		$this->ReplacementProductRequestModel  = $replacement_product_requestmodel;
		$this->BaseModel                       = $replacement_product_requestmodel;
		$this->OrdersProductModel              = $order_product;
		$this->UserWalletModel  			   = $user_wallet_model;
		$this->TransactionModel                = $transaction;

		$this->NotificationService             = $notification_service;
		$this->SmsService      				   = $sms_service;

		$this->arr_view_data                   = [];
		$this->admin_panel_slug                = config('app.project.admin_panel_slug');
		$this->admin_url_path                  = url(config('app.project.admin_panel_slug'));
		$this->module_url_path                 = $this->admin_url_path."/replacement_products";
		$this->module_title                    = "Replacement Product Requests";
		$this->module_view_folder              = "admin.replacement_products";
		$this->module_icon                     = "fa fa-refresh";
        
	}

	public function index()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);

	}

	public function load_data(Request $request)
	{
		$customer_first_name = $customer_last_name = $customer_name = $product_name = '';

		$arr_search_column      = $request->input('column_filter');

		$obj_return_request = $this->BaseModel;
		if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
		{
			$product_name = $arr_search_column['q_product_name'];
			$obj_return_request = $obj_return_request->wherehas('order_product_details',function($query) use($product_name){
				$query->where('product_name', 'LIKE', "%".$product_name."%");
			});
		}

		if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
		{
			$order_id           = $arr_search_column['q_order_id'];
			$obj_return_request = $obj_return_request->where('order_id', 'LIKE', "%".$order_id."%");
		}

		$obj_return_request = $obj_return_request->select([
													'id', 'order_id',
													'user_id',
													'order_product_id',
													'reason','delivery_method',
													'status',
													'created_at'
												])
									   			->with('order_product_details')
									   			->with(['customer_details' => function($query){
									   				$query->select('id','first_name','last_name');
									   			}])
									   			->orderBy('created_at','DESC');

		if($obj_return_request)
		{
			$json_result  = DataTables::of($obj_return_request)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$order_product_id     = '';
				$order_product_id     = isset($data->order_product_details->id)? base64_encode($data->order_product_details->id) :'';

				$built_view_href   = $this->module_url_path.'/view/'.base64_encode($data->id).'/'.$order_product_id;

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->status != null && $data->status == "1")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Request Pending" href="javascript:void(0)" >Request Pending</a>';
					}
					elseif($data->status != null && $data->status == "2")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Request Accepted" href="javascript:void(0)">Request Accepted</a>';
					}
					elseif($data->status != null && $data->status == "3")
					{
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Request Rejected" href="javascript:void(0)">Request Rejected</a>';
					}
					elseif($data->status != null && $data->status == "4")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Product replaced" href="javascript:void(0)">Completed</a>';
					}
					elseif($data->status != null && $data->status == "5")
					{
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Product Rejected" href="javascript:void(0)">Product Rejected</a>';
					}

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";

					$action_button = $built_view_button;

					$customer_first_name   = isset($data->customer_details->first_name)? $data->customer_details->first_name :'';				
					$customer_last_name    = isset($data->customer_details->last_name)? $data->customer_details->last_name :'';			

					$customer_name         = $customer_first_name.' '.$customer_last_name;	


					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->order_id            = isset($data->order_id)? $data->order_id :'';	
					$build_result->data[$key]->product_name     = isset($data->order_product_details->product_name)? $data->order_product_details->product_name :'';
					$build_result->data[$key]->customer_name           = isset($customer_name)? $customer_name :'NA';	
								
					$build_result->data[$key]->reason              = isset($data->order_id)? $data->reason :'';				
					$build_result->data[$key]->delivery_method     = isset($data->delivery_method)? $data->delivery_method :'';				
					$build_result->data[$key]->product_final_price     = isset($data->order_product_details->product_final_price)? $data->order_product_details->product_final_price :'';				
					//$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

	function view($replacement_product_enc_request_id = false,$order_product_enc_id = false)
	{
		if($replacement_product_enc_request_id != false && $order_product_enc_id != false)
		{
			$order_product_id = base64_decode($order_product_enc_id);
			$replacement_product_request_id 	= base64_decode($replacement_product_enc_request_id);
			
			$arr_product = [];
			$obj_order_product = $this->OrdersProductModel->where('id',$order_product_id)
									  ->with('supplier_details')
									  ->with('replacement_request')
									  ->with(['replacement_request.customer_details' => function($query){
									  	$query->select('id','first_name','last_name');
									  }])
									  ->with('replacement_request.wallet_details')	
									  ->with('user_bank_details')
									  ->first();
			if($obj_order_product)
			{
				$arr_product = $obj_order_product->toArray();	
			}

			//dd($arr_product);

			$this->arr_view_data['replacement_product_request_id']  = $replacement_product_request_id;
			$this->arr_view_data['arr_product']   		       = $arr_product;
			$this->arr_view_data['page_title']                 = "View ".str_singular($this->module_title);
			$this->arr_view_data['parent_module_icon']         = "icon-home2";
			$this->arr_view_data['parent_module_title']        = "Dashboard";
			$this->arr_view_data['parent_module_url']          = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['module_title']               = str_plural($this->module_title);
			$this->arr_view_data['module_url']                 = $this->module_url_path;
			$this->arr_view_data['module_icon']                = $this->module_icon;
			$this->arr_view_data['admin_panel_slug']           = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']           = "View ".str_singular($this->module_title);
			$this->arr_view_data['sub_module_icon']            = 'fa fa-eye';
			$this->arr_view_data['module_url_path']            = $this->module_url_path;

			return view($this->module_view_folder.'.view',$this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went to wrong ! Please try again later.');
			return redirect()->back();
		}
	}

	public function accept_request($return_product_request_enc_id = false)
	{
		$product_name = $admin_fname = $admin_lname = $admin_name = $order_product_id = $mobile_no = $content = '';
		if($return_product_request_enc_id != false)
		{
			$return_product_request_id = base64_decode($return_product_request_enc_id);

			$status = $this->BaseModel->where('id',$return_product_request_id)->update(['status' => '2']);
			$status = true;
			if($status)
			{
				$obj_return_product = $this->BaseModel->where('id',$return_product_request_id)
										                			  ->with(['order_product_details' => function($query){
										                				$query->select('id','product_name');
										                			  }])
										                			  ->first();
						                				
				$product_name      = $obj_return_product->order_product_details->product_name or '';
				$receiver_id       = $obj_return_product->user_id or '';
				$order_product_id  = $obj_return_product->order_product_id or '';
				$mobile_no         = $obj_return_product->mobile_number or '';

				$admin_details = login_user_details('admin');
       
       			$admin_fname = isset($admin_details->first_name) && !empty($admin_details->first_name) ? $admin_details->first_name : 'Admin';

       			$admin_lname = isset($admin_details->last_name) && !empty($admin_details->last_name) ? $admin_details->last_name : '';

       			$admin_name = $admin_fname.' '.$admin_lname;

				$arr_noti['receiver_user_id']       =  $receiver_id;  //receiver user id
				$arr_noti['receiver_user_type_id']  =  '2';
				$arr_noti['admin_name']             =  $admin_name or '';
				$arr_noti['status']                 =  'accepted';
				$arr_noti['product_name']           =  $product_name or 'NA';
				$arr_noti['url']                    =  "my_orders/details/".base64_encode($order_product_id);
				$arr_noti['notification_type']      =  '3';

				$content = $this->NotificationService->store_product_replacement_request_acceptance_rejection_notification($arr_noti);

				if(isset($mobile_no) && !empty($mobile_no) && isset($content) && !empty($content))
				{
					$this->SmsService->send_sms($content,$mobile_no);
				}
				Session::flash('success','Product replacement request accepted successfully.');
				return redirect($this->module_url_path);
			}
		}
		else
		{
			Session::flash('error','Something went to wrong ! Please try again later.');
			return redirect()->back();
		}
	}

	public function reject_request($replacement_product_request_enc_id = false)
	{
		$product_name = $admin_fname = $admin_lname = $admin_name = $order_product_id = '';
		if($replacement_product_request_enc_id != false)
		{
			$replacement_product_request_id = base64_decode($replacement_product_request_enc_id);

			$status = $this->BaseModel->where('id',$replacement_product_request_id)->update(['status' => '3']);

			if($status)
			{
				$obj_return_product = $this->BaseModel->where('id',$replacement_product_request_id)
										                			  ->with(['order_product_details' => function($query){
										                				$query->select('id','product_name');
										                			  }])
										                			  ->first();
						                				
				$product_name      = $obj_return_product->order_product_details->product_name or '';
				$receiver_id       = $obj_return_product->user_id or '';
				$order_product_id  = $obj_return_product->order_product_id or '';
				$mobile_no         = $obj_return_product->mobile_number or '';

				$admin_details = login_user_details('admin');
       
       			$admin_fname = isset($admin_details->first_name) && !empty($admin_details->first_name) ? $admin_details->first_name : 'Admin';

       			$admin_lname = isset($admin_details->last_name) && !empty($admin_details->last_name) ? $admin_details->last_name : '';

       			$admin_name = $admin_fname.' '.$admin_lname;

				$arr_noti['receiver_user_id']       =  $receiver_id;  //receiver user id
				$arr_noti['receiver_user_type_id']  =  '2';
				$arr_noti['admin_name']             =  $admin_name or '';
				$arr_noti['status']                 =  'rejected';
				$arr_noti['product_name']           =  $product_name or 'NA';
				$arr_noti['url']                    =  "my_orders/details/".base64_encode($order_product_id);
				$arr_noti['notification_type']      =  '4';

				$content = $this->NotificationService->store_product_replacement_request_acceptance_rejection_notification($arr_noti);

				if(isset($mobile_no) && !empty($mobile_no) && isset($content) && !empty($content))
				{
					$this->SmsService->send_sms($content,$mobile_no);
				}

				Session::flash('success','Product replacement request rejected successfully.');
				return redirect($this->module_url_path);
			}
		}
		else
		{
			Session::flash('error','Something went to wrong ! Please try again later.');
			return redirect()->back();
		}

	}

	public function accept_product(Request $request)
	{
		$arr_wallet = $arr_data = $arr_transaction = [];

		$arr_rules      = array();

		$amount = $usd_value = '';

		$validator = validator::make($request->all(),$arr_rules);

		
		$arr_rules['amount']  = "required";
		$arr_wallet['amount_credited']    = $request->input('amount', null);

		$amount = $request->input('amount', null);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$replacement_product_request_id = '';

		$arr_wallet['user_id']            = $request->input('user_id', null);
		$arr_wallet['order_id']           = $request->input('order_id', null);
		$arr_wallet['product_id']         = $request->input('product_id', null);
		
		$arr_wallet['transaction_status'] = '1';
		$arr_wallet['type']               = '1';

		$status = $this->UserWalletModel->create($arr_wallet);
		
		if($status)
		{
			$replacement_product_request_id    = $request->input('replacement_product_request_id', 0);


			
			$obj_return_product = $this->BaseModel->where('id',$replacement_product_request_id)
										                			  ->with(['order_product_details' => function($query){
										                				$query->select('id','product_name');
										                			  }])
										                			  ->first();
			$current_dollar_value = get_current_dollar_value();

			$product_name      = $obj_return_product->order_product_details->product_name or '';
			$order_product_id  = $obj_return_product->order_product_id or '';
			$mobile_no         = $obj_return_product->mobile_number or '';
			$usd_value         = isset($current_dollar_value) ? $current_dollar_value : 0;

			$arr_data['user_wallet_id']   = $status->id;
			$arr_data['status']           = '4';
			$arr_data['usd_value']            = isset($usd_value) ? $usd_value : 0;

			$status = $this->BaseModel->where('id',$replacement_product_request_id)->update($arr_data);

			if($status)
			{
				$arr_transaction['replacement_product_request_id'] = $replacement_product_request_id;

				$arr_transaction['amount']        = $amount;

				$arr_transaction['payment_mode']  = 'wallet';

				$date = date('Y-m-d H:i:s');

				$arr_transaction['product_id']            = $request->input('product_id', null);
				$arr_transaction['user_id']               = $request->input('user_id', null);
				$arr_transaction['payment_status']        = '1';
				$arr_transaction['trans_type']            = '4';
				$arr_transaction['trans_date']            = $date;
				$arr_transaction['order_status']          = 'Success';
				$arr_transaction['currency']              = 'INR';
				$arr_transaction['transaction_usd_value'] = isset($usd_value) ? $usd_value : '';
				
				$this->TransactionModel->create($arr_transaction);
			}

			$arr_noti['receiver_user_id']       =  $request->input('user_id', null);  //receiver user id
			$arr_noti['receiver_user_type_id']  =  '2';
			
			$arr_noti['amount']                 =  $amount or '0';

			$arr_noti['product_name']           =  $product_name or 'NA';
			
			$arr_noti['notification_type']      =  '3';
			$arr_noti['url']                    =  "my_orders/details/".base64_encode($order_product_id);;
			
			$content = $this->NotificationService->store_replacement_product_payment_release_notification($arr_noti);

			if(isset($mobile_no) && !empty($mobile_no) && isset($content) && !empty($content))
			{
				$this->SmsService->send_sms($content,$mobile_no);
			}

			Session::flash('success', "Product replacement process completed successfully.");
			return redirect($this->module_url_path);
		}
		else
		{
			Session::flash('error', 'Something went to wrong ! Please try again later.');
			return redirect()->back();
		}
		
	}

	public function reject_product($return_product_request_enc_id = false)
	{
		$product_name = $admin_fname = $admin_lname = $admin_name = $order_product_id = '';
		if($return_product_request_enc_id != false)
		{
			$return_product_request_id = base64_decode($return_product_request_enc_id);

			$status = $this->BaseModel->where('id',$return_product_request_id)->update(['status' => '5']);

			if($status)
			{
				$obj_return_product = $this->BaseModel->where('id',$return_product_request_id)
										                			  ->with(['order_product_details' => function($query){
										                				$query->select('id','product_name');
										                			  }])
										                			  ->first();
						                				
				$product_name      = $obj_return_product->order_product_details->product_name or '';
				$receiver_id       = $obj_return_product->user_id or '';
				$order_product_id  = $obj_return_product->order_product_id or '';
				$mobile_no         = $obj_return_product->mobile_number or '';

				$admin_details = login_user_details('admin');
       
       			$admin_fname = isset($admin_details->first_name) && !empty($admin_details->first_name) ? $admin_details->first_name : 'Admin';

       			$admin_lname = isset($admin_details->last_name) && !empty($admin_details->last_name) ? $admin_details->last_name : '';

       			$admin_name = $admin_fname.' '.$admin_lname;

				$arr_noti['receiver_user_id']       =  $receiver_id;  //receiver user id
				$arr_noti['receiver_user_type_id']  =  '2';
				$arr_noti['admin_name']             =  $admin_name or '';
				$arr_noti['status']                 =  'rejected';
				$arr_noti['product_name']           =  $product_name or 'NA';
				$arr_noti['url']                    =  "my_orders/details/".base64_encode($order_product_id);
				$arr_noti['notification_type']      =  '4';

				$content = $this->NotificationService->store_product_replacement_rejection_notification($arr_noti);

				if(isset($mobile_no) && !empty($mobile_no) && isset($content) && !empty($content))
				{
					$this->SmsService->send_sms($content,$mobile_no);
				}

				Session::flash('success','Product replacement request rejected successfully.');
				return redirect($this->module_url_path);
			}
		}
		else
		{
			Session::flash('error','Something went to wrong ! Please try again later.');
			return redirect()->back();
		}

	}

 
}
