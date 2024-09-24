<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Models\UserModel;
use App\Models\OrdersProductModel;
use App\Common\Traits\MultiActionTrait;

use App\Common\Services\NotificationService;

use Validator;
use Session;
use DataTables;
use DB;

class OrdersController extends Controller
{
	use MultiActionTrait;	

	public function __construct(
		UserModel           $user_model,
		OrdersModel         $OrdersModel,
		OrdersProductModel  $order_product,
		NotificationService $notification_service
		)
	{
		$this->arr_view_data                 = [];
		$this->admin_panel_slug              = config('app.project.admin_panel_slug');
		$this->admin_url_path                = url(config('app.project.admin_panel_slug'));
		$this->module_url_path               = $this->admin_url_path."/orders";
		$this->module_title                  = "Orders";
		$this->module_view_folder            = "admin.orders";
		$this->module_icon                   = "fa fa-shopping-cart";
		
		$this->BaseModel                     = $OrdersModel;
		$this->UserModel                     = $user_model;
		$this->OrdersModel                   = $OrdersModel;
		$this->OrdersProductModel            = $order_product;
		$this->NotificationService           = $notification_service;

		$this->order_invoice_base_pdf_path   = base_path().config('app.project.pdf_path.order_invoice');
		$this->order_invoice_public_pdf_path = url('/').config('app.project.pdf_path.order_invoice');
	}


	/*
    | Function  : Get the listing of all the order data
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : Show the listing of all the order data
    */

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

	} // end index


	/*
    | Function  : Get all the listing data required after page is load
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : Show all the listing data required after page is load
    */

    public function load_data(Request $request)
    {
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = '';
    	$arr_search_column      = $request->input('column_filter');

    	$obj_orders = $this->BaseModel;

    	$obj_orders = $obj_orders->select(['id', 'order_id','user_id', 'order_fname', 'order_lname', 'order_email', 'order_payment_method','created_at'])
    	->with('order_products.product_details.supplier_details')
    	->with(['order_products' => function($query){
    		$query->select('id', 'order_id', 'product_id');
    		$query->selectRaw('sum(product_final_price) as total_amount');
    		$query->groupBy('order_id');
    	}]);
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href   = $this->module_url_path.'/view/'.base64_encode($data->id);

    			$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";

    				$action_button = $built_view_button;

    				$id = isset($data->id)? base64_encode($data->id) :'';

    				if(isset($data->answer))
    				{
    					$short_answer = str_limit(strip_tags($data->answer),  100, '...'); 
    				}

    				$supplier_first_name = isset($data->order_products[0]->product_details->supplier_details->first_name) ? $data->order_products[0]->product_details->supplier_details->first_name : '';

    				$supplier_last_name = isset($data->order_products[0]->product_details->supplier_details->last_name) ? $data->order_products[0]->product_details->supplier_details->last_name : '';

    				$supplier_name = $supplier_first_name.' '.$supplier_last_name;

    				$order_by_first_name = isset($data->order_fname) ? $data->order_fname : '';
    				$order_by_last_name  = isset($data->order_lname) ? $data->order_lname : '';

    				$order_by_name = $order_by_first_name.' '.$order_by_last_name;

    				$build_result->data[$key]->id                  = $id;				
    				$build_result->data[$key]->order_id     	   = isset($data->order_id) ? $data->order_id : 'NA';				
    				$build_result->data[$key]->order_by_name       = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
    				$build_result->data[$key]->supplier_name       = isset($supplier_name) ? $supplier_name : 'NA';
    				$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
    				$build_result->data[$key]->payment_method      = 'Online';
    				$build_result->data[$key]->total               = isset($data->order_products[0]->total_amount) ? $data->order_products[0]->total_amount : 'NA';
    				$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

    				$build_result->data[$key]->build_status_check  = 'Pending';
    				$build_result->data[$key]->built_action_button = $action_button;
    			}
    		}

    		return response()->json($build_result);
    	}
	} // end load_data


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
    	
    	$this->arr_view_data['parent_module_icon']   = "icon-home2";
    	$this->arr_view_data['parent_module_title']  = "Dashboard";
    	$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
    	$this->arr_view_data['page_title']           = "Manage New ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']         = "Manage New ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']          = $this->module_icon;
    	$this->arr_view_data['module_url_path']      = $this->module_url_path;
    	$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
    	
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
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = $built_download_button = '';
    	$arr_search_column      = $request->input('column_filter');

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

    	$obj_orders = $obj_orders
    	->where(function($query){
    		$query->where('status', '1');
    		$query->orWhere('status', '2');
    		$query->orWhere('status', '3');
            $query->orWhere('status', '4');
    		$query->orWhere('status', '0');
    	})
    	->with(['order_products' => function($query){
    		$query->select('id', 'order_id', 'product_id');
    		$query->selectRaw('sum(product_final_price) as total_amount');
    		$query->groupBy('order_id');
    	}])
    	->orderBy('id','DESC');
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href         = $this->module_url_path.'/new/view/'.base64_encode($data->id);
    			$built_bank_details_href = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";
    				
    				if(file_exists($this->order_invoice_base_pdf_path.$data->order_id.'.pdf' ))
    				{
    					$invoice_path_src = $this->order_invoice_public_pdf_path.$data->order_id.'.pdf';

    					$built_download_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$invoice_path_src."' title='Download Invoice' data-original-title='Download Invoice' target='_blank' download><i class='fa fa-download' ></i></a>";
    				}

    				$action_button = $built_view_button.' '.$built_download_button;

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
    				if($status == '1'||$status == '0')
    				{
    					$order_status   = 'In-Process';
    					$btn_class      = 'btn-default';
    					$next_status    = 'Confirmed';
    					$next_btn_class = 'btn-info';
    					$built_status   = $this->module_url_path.'/status/confirm/'.base64_encode($data->id);
    				}
    				else if($status == '2')
    				{
    					$order_status   = 'Confirmed';
    					$btn_class      = 'btn-info';
    					$next_status    = 'Dispatched';
    					$next_btn_class = 'btn-warning';
    					$built_status   = $this->module_url_path.'/status/dispatch/'.base64_encode($data->id);
    				}
    				else if($status == '3')
    				{
    					$order_status   = 'Dispatched';
    					$btn_class      = 'btn-warning';
    					$next_status    = 'Delivered';
    					$next_btn_class = 'btn-primary';
    					$built_status   = $this->module_url_path.'/status/deliver/'.base64_encode($data->id);
    				}
    				else if($status == '4')
    				{
    					$order_status   = 'Delivered';
    					$btn_class      = 'btn-primary';
    					$next_status    = 'Complete';
    					$next_btn_class = 'btn-success';
    					$built_status   = $this->module_url_path.'/status/complete/'.base64_encode($data->id);
    				}

    				$current_status = '<a class="btn btn-xs '.$btn_class.'" title="'.$order_status.'" >'.$order_status.'</a>';

    				$build_status_btn = '<a class="btn btn-xs '.$next_btn_class.'" title="'.$next_status.'" href="'.$built_status.'" onclick="return confirm_action(this,event,\'Do you really want to '.$next_status.' this order?\')" >'.$next_status.'</a>';

    				$change_status_button = $build_status_btn;

    				$order_by_name = $order_by_first_name.' '.$order_by_last_name;

    				$build_result->data[$key]->id                   = $id;
    				$build_result->data[$key]->order_id     	    = isset($data->order_id) ? $data->order_id : 'NA';
    				$build_result->data[$key]->order_by_name        = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
    				$build_result->data[$key]->status               = isset($data->status)? $data->status :'';
    				$build_result->data[$key]->payment_method       = $payment_method;
    				$build_result->data[$key]->total                = isset($data->order_cost) ? $data->order_cost : 'NA';
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

    	$this->arr_view_data['parent_module_icon']   = "icon-home2";
    	$this->arr_view_data['parent_module_title']  = "Dashboard";
    	$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
    	$this->arr_view_data['page_title']           = "Manage Past ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']         = "Manage Past ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']          = $this->module_icon;
    	$this->arr_view_data['module_url_path']      = $this->module_url_path;
    	$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
    	
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
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = $built_download_button = '';
    	$arr_search_column      = $request->input('column_filter');

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

    	$obj_orders = $obj_orders
    	->where(function($query){
    		$query->where('status', '5');
    	})
    	->with(['order_products' => function($query){
    		$query->select('id', 'order_id', 'product_id');
    		$query->selectRaw('sum(product_final_price) as total_amount');
    		$query->groupBy('order_id');
    	}])
    	->orderBy('id','DESC');
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href   = $this->module_url_path.'/past/view/'.base64_encode($data->id);

    			$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";

    				if(file_exists($this->order_invoice_base_pdf_path.$data->order_id.'.pdf' ))
    				{
    					$invoice_path_src = $this->order_invoice_public_pdf_path.$data->order_id.'.pdf';

    					$built_download_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$invoice_path_src."' title='Download Invoice' data-original-title='Download Invoice' target='_blank' download><i class='fa fa-download' ></i></a>";
    				}

    				$action_button = $built_view_button.' '.$built_download_button;

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

    				$build_result->data[$key]->id                  = $id;				
    				$build_result->data[$key]->order_id     	   = isset($data->order_id) ? $data->order_id : 'NA';				
    				$build_result->data[$key]->order_by_name       = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
    				$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
    				$build_result->data[$key]->payment_method      = $payment_method;
    				$build_result->data[$key]->total               = isset($data->order_cost) ? $data->order_cost : 'NA';
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

    	$this->arr_view_data['parent_module_icon']   = "icon-home2";
    	$this->arr_view_data['parent_module_title']  = "Dashboard";
    	$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
    	$this->arr_view_data['page_title']           = "Manage Cancelled ".str_plural($this->module_title);
    	$this->arr_view_data['module_title']         = "Manage Cancelled ".str_plural($this->module_title);
    	$this->arr_view_data['module_icon']          = $this->module_icon;
    	$this->arr_view_data['module_url_path']      = $this->module_url_path;
    	$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
    	
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
    	$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = $built_download_button = '';
    	$arr_search_column      = $request->input('column_filter');

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

    	$obj_orders = $obj_orders
    	->where(function($query){
    		$query->where('status', '6');
    	})
    	->with(['order_products' => function($query){
    		$query->select('id', 'order_id', 'product_id');
    		$query->selectRaw('sum(product_final_price) as total_amount');
    		$query->groupBy('order_id');
    	}])
    	->orderBy('id','DESC');
    	
    	if($obj_orders)
    	{
    		$json_result  = DataTables::of($obj_orders)->make(true);
    		$build_result = $json_result->getData();

    		foreach ($build_result->data as $key => $data) 
    		{
    			$built_view_href   = $this->module_url_path.'/cancelled/view/'.base64_encode($data->id);

    			$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

    			if(isset($build_result->data) && sizeof($build_result->data)>0)
    			{
    				$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";

    				if(file_exists($this->order_invoice_base_pdf_path.$data->order_id.'.pdf' ))
    				{
    					$invoice_path_src = $this->order_invoice_public_pdf_path.$data->order_id.'.pdf';

    					$built_download_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$invoice_path_src."' title='Download Invoice' data-original-title='Download Invoice' target='_blank' download><i class='fa fa-download' ></i></a>";
    				}

    				$action_button = $built_view_button.' '.$built_download_button;

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
    				$build_result->data[$key]->total               = isset($data->order_cost) ? $data->order_cost : 'NA';
    				$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

    				$build_result->data[$key]->build_status_check  = $current_status;
    				$build_result->data[$key]->built_action_button = $action_button;
    			}
    		}

    		return response()->json($build_result);
    	}
	} // end cancel_load_data



	/*
    | Function  : Get order data for selected order
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : Show order data for selected order
    */

    public function view($status = false, $enc_id = false)
    {
        $order_status = '';

        if($status != false)
        {
            $order_status = $status;
        }

    	$id = base64_decode($enc_id);
    	$sub_total = 0;
    	$total = 0;
    	$insurance_product = 0;
    	$arr_orders = [];
    	$arr_price  = [];
    	$obj_orders = $this->BaseModel->where('id',$id)
    	->with('order_products')
    	->with(['bank_details'=>function($q){
    		$q->where('user_type','2');
    	}, 'order_giftcard', 'order_wallet'])	
    	->first();
    	if($obj_orders)
    	{
    		$arr_orders = $obj_orders->toArray();	
    	}

		// dd($arr_orders);


    	if(isset($arr_orders['order_products']) && sizeof($arr_orders['order_products'])>0)
    	{
    		$order_id = $arr_orders['order_id'];
    		$sub_total = $this->OrdersProductModel->where('order_id',$order_id)->sum('product_final_price');	
    		$insurance_product = $this->OrdersProductModel->where('order_id',$order_id)->sum('insurance_on_product');
    		$total = $sub_total + $insurance_product;
    	}

    	$arr_price['sub_total'] 		= $sub_total;
    	$arr_price['insurance_product'] = $insurance_product;
    	$arr_price['total'] 			= $total;
    	
        $this->arr_view_data['order_status']                  = $order_status;
    	$this->arr_view_data['arr_orders']                    = $arr_orders;
    	$this->arr_view_data['arr_price']                     = $arr_price;
    	$this->arr_view_data['id']                            = $id;
    	$this->arr_view_data['page_title']                    = "View ".ucfirst($order_status).' '.str_singular($this->module_title);
    	$this->arr_view_data['parent_module_icon']            = "icon-home2";
    	$this->arr_view_data['parent_module_title']           = "Dashboard";
    	$this->arr_view_data['parent_module_url']             = $this->admin_url_path.'/dashboard';
    	$this->arr_view_data['module_title']                  = ucfirst($order_status).' '.str_plural($this->module_title);
    	$this->arr_view_data['module_icon']                   = $this->module_icon;
    	$this->arr_view_data['module_icon']                   = $this->module_icon;
    	$this->arr_view_data['module_url']                    = $this->module_url_path.'/'.$status;
    	$this->arr_view_data['admin_panel_slug']              = $this->admin_panel_slug;
    	$this->arr_view_data['sub_module_title']              = 'View '.ucfirst($order_status).' '.str_singular($this->module_title);
    	$this->arr_view_data['sub_module_icon']               = 'fa fa-eye';
    	$this->arr_view_data['module_url_path']               = $this->module_url_path;

    	$this->arr_view_data['order_invoice_base_pdf_path']   = $this->order_invoice_base_pdf_path;
    	$this->arr_view_data['order_invoice_public_pdf_path'] = $this->order_invoice_public_pdf_path;

    	return view($this->module_view_folder.'.view',$this->arr_view_data);
    }

    public function order_product($status = false ,$enc_id = false,$order_id = false)
    {
        $order_status = '';

        if($status != false)
        {
            $order_status = $status;
        }

    	$product_id = base64_decode($enc_id);
    	$order_id 	= base64_decode($order_id);
    	
    	$arr_product = [];
    	$obj_order_product = $this->OrdersProductModel->where('id',$product_id)
    	->with('supplier_details')	
    	->first();
    	if($obj_order_product)
    	{
    		$arr_product = $obj_order_product->toArray();	
    	}
        $this->arr_view_data['order_status']        = $order_status;
    	$this->arr_view_data['order_id']			= $order_id;
    	$this->arr_view_data['arr_product']   		= $arr_product;
    	$this->arr_view_data['page_title']          = "View Order Product";
    	$this->arr_view_data['parent_module_icon']  = "icon-home2";
    	$this->arr_view_data['parent_module_title'] = "Dashboard";
    	$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
    	$this->arr_view_data['module_title']        = ucfirst($order_status).' Order details';
        $this->arr_view_data['module_url']          = $this->module_url_path.'/'.$status.'/view/'.base64_encode($order_id);
    	$this->arr_view_data['module_icon']         = $this->module_icon;
    	$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
    	$this->arr_view_data['sub_module_title']    = 'View Order Product';
    	$this->arr_view_data['sub_module_icon']     = 'fa fa-eye';
    	$this->arr_view_data['module_url_path']     = $this->module_url_path;

    	return view($this->module_view_folder.'.order_product_view',$this->arr_view_data);
    }


	/*
    | Function  : Change current status of the order to next status
    | Author    : Deepak Arvind Salunke
    | Date      : 06/06/2018
    | Output    : Success or Error
    */

    public function change_status(Request $request, $status, $enc_id)
    {
    	$id = base64_decode($enc_id);
    	$type = '';
    	if(isset($status) && !empty($status) && isset($id) && !empty($id))
    	{
    		$obj_order = $this->BaseModel->where('id', $id)->first();
    		if(count($obj_order) > 0)
    		{
    			$arr_order = $obj_order->toArray();

    			$obj_user = $this->UserModel->where('id', $arr_order['user_id'])->first();
    			if($obj_user)
    			{
    				$arr_user = $obj_user->toArray();
    			}

    			if($status == 'pending')
    			{
    				$data['status'] = '1';
    				$type   = '1';
    				
    				$new_status = 'In-Process';
    			}
    			else if($status == 'confirm')
    			{
    				$data['status'] = '2';
    				$type   = '2';
    				$new_status = 'Confirmed';
    			}
    			else if($status == 'dispatch')
    			{
    				$data['status'] = '3';
    				$type   = '3';
    				$new_status = 'Dispatched';
    			}
    			else if($status == 'deliver')
    			{
    				$data['status'] = '4';
    				$type   = '3';
    				$new_status = 'Delivered';
    			}
    			else if($status == 'complete')
    			{
    				$data['status'] = '5';
    				$type   = '3';
    				$new_status = 'Completed';
    			}
    			else if($status == 'cancel')
    			{
    				$data['status'] = '6';
    				$type   = '4';
    				$data['cancellation_reason'] = $request->input('cancellation_reason',null);

    				$new_status = 'Cancelled';
    			}

    			$query = $this->BaseModel->where('id', $id)->update($data);
    			if($query)
    			{
    				$arr_notify['order_id']  = $arr_order['order_id'];
    				$arr_notify['status']    = $new_status;
    				$arr_notify['type']    = $type;
    				$arr_notify['user_id']   = $arr_order['user_id'];
    				$arr_notify['mobile_no'] = $arr_user['mobile_number'];
    				$send_email              = $this->NotificationService->order_status_notification($arr_notify);

    				Session::flash('success', 'Order status change to '.$new_status.' successfully!');
    				if($status == 'cancel')
    				{
    					Session::flash('success', 'Order '.$new_status.' successfully!');
    					return redirect($this->module_url_path.'/new');
    				}
    			}
    			else
    			{
    				Session::flash('error', 'Something went wrong. Please try again! mail');
    			}
    		}
    		else
    		{
    			Session::flash('error', 'This order id does not exists. Please try again with correct order id!');
    		}
    	}
    	else
    	{
    		Session::flash('error', 'Something went wrong. Please try again! last');
    	}

    	return redirect()->back();

    } // end change_status

}
