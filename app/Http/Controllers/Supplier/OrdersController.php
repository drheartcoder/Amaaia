<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Models\UserModel;
use App\Models\OrdersProductModel;
use App\Models\ReturnProductRequestModel;
use App\Common\Traits\MultiActionTrait;
use App\Common\Services\NotificationService;

use Validator;
use Session;
use DataTables;
use PDF;

class OrdersController extends Controller
{
	use MultiActionTrait;	

	public function __construct(
		UserModel                 $user_model,
		OrdersModel               $OrdersModel,
		OrdersProductModel        $order_product,
		NotificationService       $notification_service,
		ReturnProductRequestModel $return_product_request_model
		)
	{
		$this->arr_view_data                 = [];
		$this->supplier_panel_slug           = config('app.project.supplier_panel_slug');
		$this->supplier_url_path             = url(config('app.project.supplier_panel_slug'));
		$this->module_url_path               = $this->supplier_url_path."/orders";
		$this->module_title                  = "Orders";
		$this->module_view_folder            = "supplier.orders";
		$this->module_icon                   = "fa fa-shopping-cart";
		
		$this->BaseModel                     = $OrdersModel;
		$this->UserModel                     = $user_model;
		$this->OrdersModel                   = $OrdersModel;
		$this->OrdersProductModel            = $order_product;
		$this->NotificationService           = $notification_service;
		$this->ReturnProductRequestModel     = $return_product_request_model;

		$this->bank_receipt_file_base_path   = base_path().config('app.project.img_path.bank_receipt');
		$this->bank_receipt_file_public_path = url('/').config('app.project.img_path.bank_receipt');
	}


	/*
    | Function  : Get the listing of all the new order data
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show the listing of all the new order data
    */

    public function new()
    {
    	if(Session::exists('back_url'))
    	{
    		Session::forget('back_url');
    		Session::put('back_url', $this->module_url_path.'/new');
    	}
    	else
    	{
    		Session::put('back_url', $this->module_url_path.'/new');
    	}
    	
    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
    	$this->arr_view_data['page_title']          = "Manage New ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']        = "Manage New ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;
    	$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
    	
    	return view($this->module_view_folder.'.new',$this->arr_view_data);

	} // end new


	/*
    | Function  : Get all the listing data required for new orders after page is load
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show all the listing data required for new orders after page is load
    */

    public function new_load_data(Request $request)
    {
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = '';
    	$arr_search_column      = $request->input('column_filter');

    	$supplier_id = login_user_id('supplier');

    	$obj_orders = $this->BaseModel;

    	if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
    	{
    		$obj_orders = $obj_orders->where('order_id', 'LIKE', "%".$arr_search_column['q_order_id']."%");	
    	}

    	if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
    	{
    		$search_name = $arr_search_column['q_user_name'];
    		$obj_orders  = $obj_orders->where(function($query) use ($search_name){
    			$query->where('order_fname', 'LIKE', "%".$search_name."%");
    			$query->orWhere('order_lname', 'LIKE', "%".$search_name."%");
    		});
    	}

    	$obj_orders = $obj_orders->select(['id', 'order_id','user_id', 'order_fname', 'order_lname', 'order_email', 'order_payment_method', 'status', 'created_at'])
    	->where(function($query){
    		$query->where('status', '1');
    		$query->orWhere('status', '2');
    		$query->orWhere('status', '3');
    		$query->orWhere('status', '4');
    	})
    	->with(['order_products' => function($query) use ($supplier_id){
    		$query->select('id', 'order_id', 'product_id','product_supplier_id','product_quantity');
    		$query->where('product_supplier_id', $supplier_id);
    		$query->selectRaw('sum(product_price) as total_amount');
    		$query->groupBy('order_id');
    	}])
    	->whereHas('order_products.product_details', function($query) use ($supplier_id){
    		$query->select('id', 'added_by_user_type', 'added_by_user_id');
    		$query->where('added_by_user_type', '3');
    	})
    	->whereHas('order_products', function($query) use($supplier_id) {
    		$query->where('product_supplier_id', $supplier_id);
    	})
    	->orderBy('id','DESC');
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href     = $this->module_url_path.'/new/view/'.base64_encode($data->id);
    			$built_download_href = $this->supplier_url_path.'/orders/download-invoice/'.base64_encode($data->id);

    			$built_bank_details_href = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";

    				$built_invoice_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_download_href."' title='View' data-original-title='View'><i class='fa fa-download' ></i></a>";

    				$action_button = $built_view_button. '  '.$built_invoice_button;

    				$id = isset($data->id)? base64_encode($data->id) :'';

    				$order_by_first_name = isset($data->order_fname) ? ucfirst($data->order_fname) : '';
    				$order_by_last_name  = isset($data->order_lname) ? ucfirst($data->order_lname) : '';

    				$order_payment_method  = isset($data->order_payment_method) ? $data->order_payment_method : '';
    				if($order_payment_method == '1')
    				{
    					$payment_method = 'Online';
    				}
    				else if($order_payment_method == '2')
    				{
    					$payment_method = 'Wire Transfer';
    				}

    				$status  = isset($data->status) ? $data->status : '';
    				if($status == '1')
    				{
    					$order_status = 'In-Process';
    					$next_status  = 'Confirmed';
    					$built_status = $this->module_url_path.'/status/confirm/'.base64_encode($data->id);
    				}
    				else if($status == '2')
    				{
    					$order_status = 'Confirmed';
    					$next_status  = 'Dispatched';
    					$built_status  = $this->module_url_path.'/status/dispatch/'.base64_encode($data->id);
    				}
    				else if($status == '3')
    				{
    					$order_status = 'Dispatched';
    					$next_status  = 'Delivered';
    					$built_status = $this->module_url_path.'/status/deliver/'.base64_encode($data->id);
    				}
    				else if($status == '4')
    				{
    					$order_status = 'Delivered';
    					$next_status  = 'Complete';
    					$built_status = $this->module_url_path.'/status/complete/'.base64_encode($data->id);
    				}

    				$current_status = '<a class="btn btn-xs btn-warning" title="'.$order_status.'" >'.$order_status.'</a>';

    				$build_status_btn = '<a class="btn btn-xs btn-primary" title="'.$next_status.'" href="'.$built_status.'" onclick="return confirm_action(this,event,\'Do you really want to '.$next_status.' this order?\')" >'.$next_status.'</a>';

    				$change_status_button = $build_status_btn;

    				$order_by_name = $order_by_first_name.' '.$order_by_last_name;

    				$product_amount = isset($data->order_products[0]->total_amount) ? $data->order_products[0]->total_amount : 'NA';
    				$product_quantity = isset($data->order_products[0]->product_quantity) ? $data->order_products[0]->product_quantity : 'NA';

    				$total_amount = $product_amount * $product_quantity;

    				$build_result->data[$key]->id                   = $id;
    				$build_result->data[$key]->order_id     	    = isset($data->order_id) ? $data->order_id : 'NA';
    				$build_result->data[$key]->order_by_name        = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
    				$build_result->data[$key]->status               = isset($data->status)? $data->status :'';
    				$build_result->data[$key]->payment_method       = $payment_method;
    				$build_result->data[$key]->total                = get_supplier_my_earning($data->order_id);
    				$build_result->data[$key]->created_at           = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

    				$build_result->data[$key]->build_status_check   = $current_status;
    				$build_result->data[$key]->change_status_button = $change_status_button;
    				$build_result->data[$key]->built_action_button  = $action_button;
    			}
    		}

    		return response()->json($build_result);
    	}
	} // end new_load_data


	/*
    | Function  : Get the listing of all the past order data
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show the listing of all the past order data
    */

    public function past()
    {
    	if(Session::exists('back_url'))
    	{
    		Session::forget('back_url');
    		Session::put('back_url', $this->module_url_path.'/past');
    	}
    	else
    	{
    		Session::put('back_url', $this->module_url_path.'/past');
    	}

    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
    	$this->arr_view_data['page_title']          = "Manage Past ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']        = "Manage Past ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;
    	$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
    	
    	return view($this->module_view_folder.'.past',$this->arr_view_data);

	} // end past


	/*
    | Function  : Get all the listing data required for past orders after page is load
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show all the listing data required for past orders after page is load
    */

    public function past_load_data(Request $request)
    {
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = '';
    	$arr_search_column      = $request->input('column_filter');

    	$supplier_id = login_user_id('supplier');

    	$obj_orders = $this->BaseModel;

    	if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
    	{
    		$obj_orders = $obj_orders->where('order_id', 'LIKE', "%".$arr_search_column['q_order_id']."%");	
    	}

    	if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
    	{
    		$search_name = $arr_search_column['q_user_name'];
    		$obj_orders  = $obj_orders->where(function($query) use ($search_name){
    			$query->where('order_fname', 'LIKE', "%".$search_name."%");
    			$query->orWhere('order_lname', 'LIKE', "%".$search_name."%");
    		});
    	}

    	$obj_orders = $obj_orders->select(['id', 'order_id','user_id', 'order_fname', 'order_lname', 'order_email', 'order_payment_method', 'status', 'created_at'])
    	->where(function($query){
    		$query->where('status', '5');
    	})
    	->with(['order_products' => function($query) use ($supplier_id){
    		$query->select('id', 'order_id', 'product_id','product_supplier_id','product_quantity');
    		$query->where('product_supplier_id', $supplier_id);
    		$query->selectRaw('sum(product_price) as total_amount');
    		$query->groupBy('order_id');
    	}])
    	->whereHas('order_products.product_details', function($query) use ($supplier_id){
    		$query->select('id', 'added_by_user_type', 'added_by_user_id');
    		$query->where('added_by_user_type', '3');
    	})
    	->whereHas('order_products', function($query) use($supplier_id) {
    		$query->where('product_supplier_id', $supplier_id);
    	})
    	->orderBy('id','DESC');
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href   = $this->module_url_path.'/past/view/'.base64_encode($data->id);
                $built_download_href = $this->supplier_url_path.'/orders/download-invoice/'.base64_encode($data->id);

    			$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";
                    $built_invoice_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_download_href."' title='View' data-original-title='View'><i class='fa fa-download' ></i></a>";

    				$action_button = $built_view_button.' '.$built_invoice_button;

    				$id = isset($data->id)? base64_encode($data->id) :'';

    				$order_by_first_name = isset($data->order_fname) ? ucfirst($data->order_fname) : '';
    				$order_by_last_name  = isset($data->order_lname) ? ucfirst($data->order_lname) : '';

    				$order_payment_method  = isset($data->order_payment_method) ? $data->order_payment_method : '';
    				if($order_payment_method == '1')
    				{
    					$payment_method = 'Online';
    				}
    				else if($order_payment_method == '2')
    				{
    					$payment_method = 'Wire Transfer';
    				}

    				$status  = isset($data->status) ? $data->status : '';
    				if($status == '5')
    				{
    					$order_status = 'Completed';
    				}

    				$current_status = '<a class="btn btn-xs btn-success" title="'.$order_status.'" >'.$order_status.'</a>';

    				$order_by_name = $order_by_first_name.' '.$order_by_last_name;

    				$product_amount = isset($data->order_products[0]->total_amount) ? $data->order_products[0]->total_amount : 'NA';
    				$product_quantity = isset($data->order_products[0]->product_quantity) ? $data->order_products[0]->product_quantity : 'NA';

    				$total_amount = $product_amount * $product_quantity;

    				$build_result->data[$key]->id                  = $id;				
    				$build_result->data[$key]->order_id     	   = isset($data->order_id) ? $data->order_id : 'NA';				
    				$build_result->data[$key]->order_by_name       = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
    				$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
    				$build_result->data[$key]->payment_method      = $payment_method;
    				$build_result->data[$key]->total               = get_supplier_my_earning($data->order_id);
    				$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

    				$build_result->data[$key]->build_status_check  = $current_status;
    				$build_result->data[$key]->built_action_button = $action_button;
    			}
    		}

    		return response()->json($build_result);
    	}
	} // end past_load_data



	/*
    | Function  : Get the listing of all the cancel order data
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show the listing of all the cancel order data
    */

    public function cancel()
    {
    	if(Session::exists('back_url'))
    	{
    		Session::forget('back_url');
    		Session::put('back_url', $this->module_url_path.'/cancelled');
    	}
    	else
    	{
    		Session::put('back_url', $this->module_url_path.'/cancelled');
    	}

    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
    	$this->arr_view_data['page_title']          = "Manage Cancelled ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']        = "Manage Cancelled ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;
    	$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
    	
    	return view($this->module_view_folder.'.cancel',$this->arr_view_data);

	} // end cancel


	/*
    | Function  : Get all the listing data required for cancel orders after page is load
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show all the listing data required for cancel orders after page is load
    */

    public function cancel_load_data(Request $request)
    {
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = '';
    	$arr_search_column      = $request->input('column_filter');

    	$supplier_id = login_user_id('supplier');

    	$obj_orders = $this->BaseModel;

    	if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
    	{
    		$obj_orders = $obj_orders->where('order_id', 'LIKE', "%".$arr_search_column['q_order_id']."%");	
    	}

    	if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
    	{
    		$search_name = $arr_search_column['q_user_name'];
    		$obj_orders  = $obj_orders->where(function($query) use ($search_name){
    			$query->where('order_fname', 'LIKE', "%".$search_name."%");
    			$query->orWhere('order_lname', 'LIKE', "%".$search_name."%");
    		});
    	}

    	$obj_orders = $obj_orders->select(['id', 'order_id','user_id', 'order_fname', 'order_lname', 'order_email', 'order_payment_method', 'status', 'created_at'])
    	->where(function($query){
    		$query->where('status', '6');
    	})
    	->with(['order_products' => function($query) use ($supplier_id){
    		$query->select('id', 'order_id', 'product_id','product_supplier_id');
    		$query->where('product_supplier_id', $supplier_id);
    		$query->selectRaw('sum(product_price) as total_amount');
    		$query->groupBy('order_id');
    	}])
    	->whereHas('order_products.product_details', function($query) use ($supplier_id){
    		$query->select('id', 'added_by_user_type', 'added_by_user_id');
    		$query->where('added_by_user_type', '3');
    	})
    	->whereHas('order_products', function($query) use($supplier_id) {
    		$query->where('product_supplier_id', $supplier_id);
    	})
    	->orderBy('id','DESC');
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href   = $this->module_url_path.'/cancelled/view/'.base64_encode($data->id);
                $built_download_href = $this->supplier_url_path.'/orders/download-invoice/'.base64_encode($data->id);

    			$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";
                    $built_invoice_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_download_href."' title='View' data-original-title='View'><i class='fa fa-download' ></i></a>";

    				$action_button = $built_view_button.' '.$built_invoice_button;

    				$id = isset($data->id)? base64_encode($data->id) :'';

    				$order_by_first_name = isset($data->order_fname) ? ucfirst($data->order_fname) : '';
    				$order_by_last_name  = isset($data->order_lname) ? ucfirst($data->order_lname) : '';

    				$order_payment_method  = isset($data->order_payment_method) ? $data->order_payment_method : '';
    				if($order_payment_method == '1')
    				{
    					$payment_method = 'Online';
    				}
    				else if($order_payment_method == '2')
    				{
    					$payment_method = 'Wire Transfer';
    				}

    				$status  = isset($data->status) ? $data->status : '';
    				if($status == '6')
    				{
    					$order_status = 'Cancelled';
    				}

    				$current_status = '<a class="btn btn-xs btn-danger" title="'.$order_status.'" >'.$order_status.'</a>';

    				$order_by_name = $order_by_first_name.' '.$order_by_last_name;

    				$build_result->data[$key]->id                  = $id;				
    				$build_result->data[$key]->order_id     	   = isset($data->order_id) ? $data->order_id : 'NA';				
    				$build_result->data[$key]->order_by_name       = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
    				$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
    				$build_result->data[$key]->payment_method      = $payment_method;
    				$build_result->data[$key]->total               = get_supplier_my_earning($data->order_id);
    				$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

    				$build_result->data[$key]->build_status_check  = $current_status;
    				$build_result->data[$key]->built_action_button = $action_button;
    			}
    		}

    		return response()->json($build_result);
    	}
	} // end cancel_load_data


	/*
    | Function  : Get the listing of all the return order data
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show the listing of all the return order data
    */

    public function return()
    {
    	if(Session::exists('back_url'))
    	{
    		Session::forget('back_url');
    		Session::put('back_url', $this->module_url_path.'/return');
    	}
    	else
    	{
    		Session::put('back_url', $this->module_url_path.'/return');
    	}

    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
    	$this->arr_view_data['page_title']          = "Manage Return ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']        = "Manage Return ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;
    	$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
    	
    	return view($this->module_view_folder.'.return.index',$this->arr_view_data);

	} // end return


	/*
    | Function  : Get all the listing data required for return orders after page is load
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Show all the listing data required for return orders after page is load
    */

    public function return_load_data(Request $request)
    {
    	$customer_first_name = $customer_last_name = $customer_name = $product_name = '';
    	
    	$arr_search_column   = $request->input('column_filter');
    	$obj_return_request  = $this->ReturnProductRequestModel;

    	if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
    	{
    		$product_name       = $arr_search_column['q_product_name'];
    		$obj_return_request = $obj_return_request->wherehas('order_product_details',function($query) use($product_name){
    			$query->where('product_name', 'LIKE', "%".$product_name."%");
    		});
    	}

    	$supplier_id = login_user_id('supplier');

    	$obj_return_request = $obj_return_request->select(['id','order_id','user_id','order_product_id','reason','delivery_method','refund_payment_method','status','created_at'])
    	->with('order_product_details')
    	->with(['customer_details' => function($query){
    		$query->select('id','first_name','last_name');
    	}])
                                                /*->whereHas('order_product_details.product_details', function($query) use ($supplier_id){
                                                    $query->select('id', 'added_by_user_type', 'added_by_user_id');
                                                    $query->where('added_by_user_type', '3');
                                                })*/
                                                ->whereHas('order_product_details', function($query) use($supplier_id) {
                                                	$query->where('product_supplier_id', $supplier_id);
                                                })
                                                ->orderBy('created_at','DESC');

                                                if($obj_return_request)
                                                {
                                                	$json_result  = DataTables::of($obj_return_request)->make(true);
                                                	$build_result = $json_result->getData();

                                                	foreach ($build_result->data as $key => $data) 
                                                	{

                                                		$order_product_id     = '';
                                                		$order_product_id     = isset($data->order_product_details->id)? base64_encode($data->order_product_details->id) :'';

                                                		$built_view_href   = $this->module_url_path.'/return/view/'.base64_encode($data->id).'/'.$order_product_id;
                                                        $built_download_href = $this->supplier_url_path.'/orders/return-download-invoice/'.base64_encode($data->id).'/'.base64_encode($data->order_product_id);

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
                                                				$build_status_btn = '<a class="btn btn-xs btn-success" title="Amount returned" href="javascript:void(0)">Completed</a>';
                                                			}
                                                			elseif($data->status != null && $data->status == "5")
                                                			{
                                                				$build_status_btn = '<a class="btn btn-xs btn-danger" title="Product Rejected" href="javascript:void(0)">Product Rejected</a>';
                                                			}

                                                			$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";
                                                            $built_invoice_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_download_href."' title='View' data-original-title='View'><i class='fa fa-download' ></i></a>";

                                                			$action_button       = $built_view_button.' '.$built_invoice_button;

                                                			$customer_first_name = isset($data->customer_details->first_name)? $data->customer_details->first_name :'';
                                                			$customer_last_name  = isset($data->customer_details->last_name)? $data->customer_details->last_name :'';
                                                			$customer_name       = $customer_first_name.' '.$customer_last_name;
                                                			$id                  = isset($data->id)? base64_encode($data->id) :'';

                                                			$build_result->data[$key]->id                  = $id;
                                                			$build_result->data[$key]->order_id            = isset($data->order_id)? $data->order_id :'';
                                                			$build_result->data[$key]->product_name        = isset($data->order_product_details->product_name)? $data->order_product_details->product_name :'';
                                                			$build_result->data[$key]->customer_name       = isset($customer_name)? $customer_name :'NA';
                                                			$build_result->data[$key]->reason              = isset($data->order_id)? $data->reason :'';
                                                			$build_result->data[$key]->delivery_method     = isset($data->delivery_method)? $data->delivery_method :'';
                                                			$build_result->data[$key]->product_final_price = isset($data->order_product_details->product_final_price)? $data->order_product_details->product_final_price : '';
                                                			$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

                                                			$build_result->data[$key]->build_status_check  = $build_status_btn;
                                                			$build_result->data[$key]->built_action_button = $action_button;

                                                		}
                                                	}
                                                	return response()->json($build_result);
                                                }
	} // end return_load_data


	/*
    | Function  : Get order data for selected order
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : Show order data for selected order
    */

    public function view($status = false, $enc_id = false)
    {
    	$order_status = '';
    	$order_status = '';

    	if($status != false)
    	{
    		$order_status = $status;
    	}

    	$id                = base64_decode($enc_id);
    	$sub_total         = 0;
    	$total             = 0;
    	$insurance_product = 0;
    	$arr_orders        = [];
    	$arr_price         = [];
    	$supplier_id       = login_user_id('supplier');

    	$obj_orders = $this->BaseModel->where('id',$id)
    	->with(['order_products' => function($query) use ($supplier_id){
    		$query->where('product_supplier_id', $supplier_id);
    	}])
    	->first();
    	if($obj_orders)
    	{
    		$arr_orders = $obj_orders->toArray();	
    	}

    	if(isset($arr_orders['order_products']) && sizeof($arr_orders['order_products'])>0)
    	{
    		$order_id          = $arr_orders['order_id'];
    		$sub_total         = $this->OrdersProductModel->where('order_id',$order_id)->sum('product_final_price');	
    		$insurance_product = $this->OrdersProductModel->where('order_id',$order_id)->sum('insurance_on_product');
    		$total             = $sub_total + $insurance_product;
    	}

    	$arr_price['sub_total'] 		= $sub_total;
    	$arr_price['insurance_product'] = $insurance_product;
    	$arr_price['total'] 			= $total;

    	$this->arr_view_data['order_status']        = $order_status;
    	$this->arr_view_data['arr_orders']          = $arr_orders;
    	$this->arr_view_data['arr_price']			= $arr_price;
    	$this->arr_view_data['id']                  = $id;
    	$this->arr_view_data['page_title']          = "View ".ucfirst($order_status).' '.str_singular($this->module_title);
    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
    	$this->arr_view_data['module_title']        = ucfirst($order_status).' '.str_plural($this->module_title);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_url']          = $this->module_url_path.'/'.$status;
    	$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
    	$this->arr_view_data['sub_module_title']    = 'View '.ucfirst($order_status).' '.str_singular($this->module_title);
    	$this->arr_view_data['sub_module_icon']     = 'fa fa-eye';
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;

    	return view($this->module_view_folder.'.view',$this->arr_view_data);
    }

    public function order_product($status = false ,$enc_id,$order_id)
    {
    	$product_id = base64_decode($enc_id);
    	$order_id 	= base64_decode($order_id);

    	$order_status = '';

    	if($status != false)
    	{
    		$order_status = $status;
    	}
    	
    	$arr_product = [];
    	$obj_order_product = $this->OrdersProductModel->where('id',$product_id)
    	->with('supplier_details')	
    	->first();
    	if($obj_order_product)
    	{
    		$arr_product = $obj_order_product->toArray();	
    	}

    	$this->arr_view_data['order_status']        = $order_status;
    	$this->arr_view_data['order_id']            = $order_id;
    	$this->arr_view_data['arr_product']         = $arr_product;
    	$this->arr_view_data['page_title']          = "View ".ucfirst($order_status)." Order Product";
    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
    	$this->arr_view_data['module_title']        = str_plural($this->module_title);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['module_url']          = $this->module_url_path.'/'.$status.'/view/'.base64_encode($order_id);
    	$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
    	$this->arr_view_data['sub_module_title']    = 'View '.ucfirst($order_status).' Order';
    	$this->arr_view_data['sub_module_icon']     = 'fa fa-eye';
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;

    	return view($this->module_view_folder.'.order_product_view',$this->arr_view_data);
    }


    public function return_view($return_product_request_enc_id = false,$order_product_enc_id = false)
    {
    	if($return_product_request_enc_id != false && $order_product_enc_id != false)
    	{
    		$order_product_id = base64_decode($order_product_enc_id);
    		$return_product_request_id 	= base64_decode($return_product_request_enc_id);
    		
    		$arr_product = [];
    		$obj_order_product = $this->OrdersProductModel->where('id',$order_product_id)
    		->with('supplier_details')
    		->with('return_request')
    		->with(['return_request.customer_details' => function($query){
    			$query->select('id','first_name','last_name');
    		}])
    		->with('return_request.wallet_details')	
    		->with('user_bank_details')
    		->first();
    		if($obj_order_product)
    		{
    			$arr_product = $obj_order_product->toArray();	
    		}

    		$this->arr_view_data['bank_receipt_file_base_path']       = $this->bank_receipt_file_base_path;
    		$this->arr_view_data['bank_receipt_file_public_path']     = $this->bank_receipt_file_public_path;

    		$this->arr_view_data['return_product_request_id']  = $return_product_request_id;
    		$this->arr_view_data['arr_product']   		       = $arr_product;
    		$this->arr_view_data['page_title']                 = "View Order Product";
    		$this->arr_view_data['parent_module_icon']         = "icon-home2";
    		$this->arr_view_data['parent_module_title']        = "Dashboard";
    		$this->arr_view_data['parent_module_url']          = $this->supplier_url_path.'/dashboard';
    		$this->arr_view_data['module_title']               = str_plural($this->module_title);
    		$this->arr_view_data['module_url']                 = $this->module_url_path.'/return';
    		$this->arr_view_data['module_icon']                = $this->module_icon;
    		$this->arr_view_data['admin_panel_slug']           = $this->supplier_panel_slug;
    		$this->arr_view_data['sub_module_title']           = 'View Order';
    		$this->arr_view_data['sub_module_icon']            = 'fa fa-eye';
    		$this->arr_view_data['module_url_path']            = $this->module_url_path;

    		return view($this->module_view_folder.'.return.view',$this->arr_view_data);
    	}
    	else
    	{
    		Session::flash('error','Something went to wrong ! Please try again later.');
    		return redirect()->back();
    	}
    }

    public function download_invoice($enc_id)
    {

        $id                = base64_decode($enc_id);
        $sub_total         = 0;
        $total             = 0;
        $insurance_product = 0;
        $arr_orders        = [];
        $arr_price         = [];
        $supplier_id       = login_user_id('supplier');

        $obj_orders = $this->BaseModel->where('id',$id)
                                      ->with(['order_products' => function($query) use ($supplier_id){
                                        $query->where('product_supplier_id', $supplier_id);
                                      }])
                                      ->first();
        if($obj_orders)
        {
            $arr_orders = $obj_orders->toArray();   
        }

        if(isset($arr_orders['order_products']) && sizeof($arr_orders['order_products'])>0)
        {
            $order_id          = $arr_orders['order_id'];
            $sub_total         = $this->OrdersProductModel->where('order_id',$order_id)->sum('product_final_price');    
            $insurance_product = $this->OrdersProductModel->where('order_id',$order_id)->sum('insurance_on_product');
            $total             = $sub_total + $insurance_product;
        }

        $arr_price['sub_total']            = $sub_total;
        $arr_price['insurance_product']    = $insurance_product;
        $arr_price['total']                = $total;
        $this->arr_view_data['arr_orders'] = $arr_orders;
        $this->arr_view_data['arr_price']  = $arr_price;
        //dd($arr_price,$arr_orders);
        $pdf = PDF::loadView('supplier.invoice.invoice_pdf', $this->arr_view_data);

        if($pdf)
        {
          return $pdf->download('order_invoice.pdf');   
        }
         //return true;
    }

    public function download_return_invoice($return_product_request_enc_id = false,$order_product_enc_id = false)
	{

        if($return_product_request_enc_id != false && $order_product_enc_id != false)
        {
            $order_product_id = base64_decode($order_product_enc_id);
            $return_product_request_id  = base64_decode($return_product_request_enc_id);
            
            $arr_return = [];
            $obj_return = $this->ReturnProductRequestModel->where('id',$return_product_request_id)
            ->with('order_product_details','customer_details','wallet_details','order_details')
            ->first();
            if($obj_return)
            {
                $arr_return = $obj_return->toArray();   
            }

            //dd($arr_return);

            $this->arr_view_data['bank_receipt_file_base_path']       = $this->bank_receipt_file_base_path;
            $this->arr_view_data['bank_receipt_file_public_path']     = $this->bank_receipt_file_public_path;

            $this->arr_view_data['return_product_request_id']  = $return_product_request_id;
            $this->arr_view_data['arr_return']                = $arr_return;
            $this->arr_view_data['page_title']                 = "View Order Product";
            $this->arr_view_data['parent_module_icon']         = "icon-home2";
            $this->arr_view_data['parent_module_title']        = "Dashboard";
            $this->arr_view_data['parent_module_url']          = $this->supplier_url_path.'/dashboard';
            $this->arr_view_data['module_title']               = str_plural($this->module_title);
            $this->arr_view_data['module_url']                 = $this->module_url_path.'/return';
            $this->arr_view_data['module_icon']                = $this->module_icon;
            $this->arr_view_data['admin_panel_slug']           = $this->supplier_panel_slug;
            $this->arr_view_data['sub_module_title']           = 'View Order';
            $this->arr_view_data['sub_module_icon']            = 'fa fa-eye';
            $this->arr_view_data['module_url_path']            = $this->module_url_path;



            $pdf = PDF::loadView('supplier.invoice.return_invoice_pdf', $this->arr_view_data);

            if($pdf)
            {
              return $pdf->download('product_return_invoice.pdf');   
            }
        }
        else
        {
            Session::flash('error','Something went to wrong ! Please try again later.');
            return redirect()->back();
        }

	}

}
