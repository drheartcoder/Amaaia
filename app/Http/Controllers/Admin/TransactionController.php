<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;

use App\Common\Services\NotificationService;
use App\Models\UserWalletModel;
use App\Models\TransactionModel;

use DataTables;
use Session;
use DB;

class TransactionController extends Controller
{
	use MultiActionTrait;

	public function __construct(
		UserWalletModel     $user_wallet_model,
		NotificationService $notification_service,
		TransactionModel $transaction
		)
	{
		$this->arr_data                       = [];
		$this->admin_panel_slug               = config('app.project.admin_panel_slug');
		$this->admin_url_path                 = url(config('app.project.admin_panel_slug'));
		$this->module_url_path                = $this->admin_url_path."/transaction";
		$this->module_title                   = "Transaction";
		$this->module_view_folder             = "admin.transaction";
		$this->module_icon                    = "fa fa-money";

		$this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');

		$this->UserWalletModel                = $user_wallet_model;
		$this->NotificationService            = $notification_service;
		$this->TransactionModel               = $transaction;
	}



	public function wallet()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage Wallet ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage Wallet ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path.'/wallet';
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.wallet.index',$this->arr_view_data);

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');

		$obj_wallet = $this->UserWalletModel;
		
		// serach user_name
		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$username_search = $arr_search_column['q_user_name'];
			$obj_wallet = $obj_wallet->whereHas('user_details', function($query) use($username_search){
				$query->where('first_name', 'LIKE', "%".$username_search."%");
				$query->orWhere('last_name', 'LIKE', "%".$username_search."%");
				$query->orWhere(function($q) use($username_search){
					$q->whereIn('last_name', explode(' ',$username_search));
					$q->orwhereIn('last_name', explode(' ',$username_search));
				});
			});		
		}

		// serach email
		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$email_search = $arr_search_column['q_email'];
			$obj_wallet = $obj_wallet->whereHas('user_details', function($query) use($email_search){
				$query->where('email', 'LIKE', "%".$email_search."%");
			});		
		}

		$obj_wallet = $obj_wallet->select(['id', 'user_id', 'order_id', 'amount_debited','amount_credited','transaction_status','updated_at'])
		->with(['user_details' => function($query)
		{
			$query->select('id','first_name','last_name', 'email');
		}])
		->groupBy('user_id');

		if($obj_wallet)
		{
			$json_result  = DataTables::of($obj_wallet)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_view_btn_href   = $this->module_url_path.'/wallet/view/'.base64_encode($data->user_id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_btn_href."' title='View' data-original-title='View'><i class='fa fa-eye'></i></a>";

					$action_button = $built_view_button;
					
					$user_id    = isset($data->user_id)? base64_encode($data->user_id) :'';
					$first_name = isset($data->user_details->first_name) ? $data->user_details->first_name : '';
					$last_name  = isset($data->user_details->last_name) ? $data->user_details->last_name : '';

					$build_result->data[$key]->user_id             = $user_id;
					$build_result->data[$key]->user_name           = $first_name.' '.$last_name;
					$build_result->data[$key]->email               = isset($data->user_details->email) ? $data->user_details->email : '';
					$build_result->data[$key]->wallet_amount       = '₹ '.wallet_total(base64_decode($user_id));
					$build_result->data[$key]->updated_at          = isset($data->updated_at)? get_formated_created_date($data->updated_at) :'';
					$build_result->data[$key]->built_action_button = $action_button;
				}
			}
			return response()->json($build_result);
		}
	}


	public function view($enc_id = false)
	{
		$arr_wallet = [];

		if($enc_id != false)
		{
			$user_id = base64_decode($enc_id);

			$obj_wallet = $this->UserWalletModel->where('user_id' , $user_id)
			->with(['user_details' => function($query)
			{
				$query->select('id','first_name','last_name','gender','address', 'country_phone_code_id','mobile_number','email','profile_image');
			}])
			->first();

			if($obj_wallet)
			{
				$arr_wallet = $obj_wallet->toArray();
			}

			$this->arr_view_data['arr_wallet']                       = $arr_wallet;

			$this->arr_view_data['user_profile_image_base_path']   = $this->user_profile_image_base_path;
			$this->arr_view_data['user_profile_image_public_path'] = $this->user_profile_image_public_path;

			$this->arr_view_data['parent_module_icon']             = "icon-home2";
			$this->arr_view_data['parent_module_title']            = "Dashboard";
			$this->arr_view_data['parent_module_url']              = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['page_title']                     = "View Wallet ".str_plural($this->module_title);
			$this->arr_view_data['module_title']                   = "Manage Wallet ".str_plural($this->module_title);
			$this->arr_view_data['module_icon']                    = $this->module_icon;
			$this->arr_view_data['module_view_path']               = $this->module_url_path.'/wallet';
			$this->arr_view_data['module_url_path']                = $this->module_url_path;
			$this->arr_view_data['admin_panel_slug']               = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']               = 'View Wallet '.str_singular($this->module_title);
			$this->arr_view_data['sub_module_icon']                = 'fa fa-eye';
			$this->arr_view_data['id']                             = $user_id;
			$this->arr_view_data['enc_id']                         = $enc_id;
			$this->arr_view_data['module_url']                         = $this->module_url_path.'/wallet';

			return view($this->module_view_folder.'.wallet.view',$this->arr_view_data);
			
		}
		else
		{
			Session::flash('error','Something went to wrong! Please try again later.');
			return redirect()->back();
		}	
	}


	/*
    | Function  : Get all the products data
    | Author    : Deepak Arvind Salunke
    | Date      : 22/05/2018
    | Output    : Show listing of all the products data
    */

    public function load_details(Request $request, $id = false)
    {
    	$arr_search_column = $request->input('column_filter');

    	$obj_wallet = $this->UserWalletModel->where('user_id', $id);

		// serach order id
    	if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
    	{
    		$order_id_search = $arr_search_column['q_order_id'];
    		$obj_wallet = $obj_wallet->where('order_id', 'LIKE', "%".$order_id_search."%");
    	}

		//dd($obj_wallet->get()->toArray());

    	if($obj_wallet)
    	{
    		$json_result  = DataTables::of($obj_wallet)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$id         = isset($data->id)? base64_encode($data->id) :'';

    				if($data->transaction_status == '1')
    				{
    					$transaction_status = '<a class="btn btn-xs btn-success" title="Success">Success</a>';
    				}
    				else if($data->transaction_status == '2')
    				{
    					$transaction_status = '<a class="btn btn-xs btn-danger" title="Failure">Failure</a>';
    				}
    				else if($data->transaction_status == '3')
    				{
    					$transaction_status = '<a class="btn btn-xs btn-info" title="Pending">Pending</a>';
    				}

    				if($data->amount_credited == '0')
    				{
    					$amount_credited = '';
    				}
    				else
    				{
    					$amount_credited = '₹ '.$data->amount_credited;
    				}

    				if($data->amount_debited == '0')
    				{
    					$amount_debited = '';
    				}
    				else
    				{
    					$amount_debited = '₹ '.$data->amount_debited;
    				}

    				$build_result->data[$key]->id                 = $id;
    				$build_result->data[$key]->order_id           = isset($data->order_id) ? $data->order_id :'';
    				$build_result->data[$key]->amount_credited    = isset($amount_credited) ? $amount_credited :'';
    				$build_result->data[$key]->amount_debited     = isset($amount_debited) ? $amount_debited :'';
    				$build_result->data[$key]->transaction_status = isset($transaction_status) ? $transaction_status :'';
    				$build_result->data[$key]->created_at         = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';
    			}
    		}
    		return response()->json($build_result);
    	}
	} // end load_details

	public function product_transaction()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage Product ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage Product ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path.'/product';
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		return view($this->module_view_folder.'.product.index',$this->arr_view_data);
	}

	public function load_product_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');
		$obj_product = $this->TransactionModel;

		// serach user_name
		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$username_search = $arr_search_column['q_user_name'];
			$obj_product = $obj_product->whereHas('user_details', function($query) use($username_search){
				$query->where('first_name', 'LIKE', "%".$username_search."%");
				$query->orWhere('last_name', 'LIKE', "%".$username_search."%");
				$query->orWhere(function($q) use($username_search){
					$q->whereIn('last_name', explode(' ',$username_search));
					$q->orwhereIn('last_name', explode(' ',$username_search));
				});
				
			});		
		}

		// serach email
		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$email_search = $arr_search_column['q_email'];
			$obj_product = $obj_product->whereHas('user_details', function($query) use($email_search){
				$query->where('email', 'LIKE', "%".$email_search."%");
			});		
		}

			// serach order id
		if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
		{
			$order_id_search = $arr_search_column['q_order_id'];
			$obj_product = $obj_product->where('order_id', 'LIKE', "%".$order_id_search."%");
			
		}

		$obj_product = $obj_product->select(['transaction_id','tracking_id','order_id', 'bank_ref_no','order_status','payment_status','amount','user_id','created_at'])
		->with(['user_details' => function($query)
		{
			$query->select('id','first_name','last_name', 'email');
		}])
		->orderBy('created_at')->get();
		
		if($obj_product)
		{
			$json_result  = DataTables::of($obj_product)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{

				$built_view_btn_href   = $this->module_url_path.'/product/view/'.base64_encode($data->transaction_id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_btn_href."' title='View' data-original-title='View'><i class='fa fa-eye'></i></a>";

					$action_button = $built_view_button;
					
					$user_id    = isset($data->user_id)? base64_encode($data->user_id) :'';
					$first_name = isset($data->user_details->first_name) ? $data->user_details->first_name : '';
					$last_name  = isset($data->user_details->last_name) ? $data->user_details->last_name : '';

					$build_result->data[$key]->user_id             = $user_id;
					$build_result->data[$key]->user_name           = $first_name.' '.$last_name;
					$build_result->data[$key]->email               = isset($data->user_details->email) ? $data->user_details->email : '';
					$build_result->data[$key]->order_id            = $data->order_id; 
					$build_result->data[$key]->amount       	   = '₹ '.$data->amount;
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';
					$build_result->data[$key]->built_action_button = $action_button;
				}
			}
			return response()->json($build_result);
		}
		
	}


	public function view_product($enc_id)
	{
		$arr_product = [];

		if($enc_id != false)
		{
			$transaction_id = base64_decode($enc_id);

			$obj_product = $this->TransactionModel->where('transaction_id' , $transaction_id)
			->with(['user_details' => function($query)
			{
				$query->select('id','first_name','last_name','gender','address', 'country_phone_code_id','mobile_number','email','profile_image');
			}])
			->first();

			if($obj_product)
			{
				$arr_product = $obj_product->toArray();
			}
			//dd($arr_product);
			$this->arr_view_data['arr_product']                       = $arr_product;

			$this->arr_view_data['user_profile_image_base_path']   = $this->user_profile_image_base_path;
			$this->arr_view_data['user_profile_image_public_path'] = $this->user_profile_image_public_path;

			$this->arr_view_data['parent_module_icon']             = "icon-home2";
			$this->arr_view_data['parent_module_title']            = "Dashboard";
			$this->arr_view_data['parent_module_url']              = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['page_title']                     = "View product ".str_plural($this->module_title);
			$this->arr_view_data['module_title']                   = "Manage Product ".str_plural($this->module_title);
			$this->arr_view_data['module_icon']                    = $this->module_icon;
			$this->arr_view_data['module_view_path']               = $this->module_url_path.'/product';
			$this->arr_view_data['module_url_path']                = $this->module_url_path;
			$this->arr_view_data['admin_panel_slug']               = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']               = 'View Product '.str_singular($this->module_title);
			$this->arr_view_data['sub_module_icon']                = 'fa fa-eye';
			$this->arr_view_data['enc_id']                         = $enc_id;
			$this->arr_view_data['module_url']                         = $this->module_url_path.'/product';

			return view($this->module_view_folder.'.product.view',$this->arr_view_data);
			
		}
		else
		{
			Session::flash('error','Something went to wrong! Please try again later.');
			return redirect()->back();
		}	

	}

}
