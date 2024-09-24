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

class MyEarningsController extends Controller
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
		$this->module_url_path               = $this->admin_url_path."/earnings";
		$this->module_title                  = "My Earnings";
		$this->module_view_folder            = "admin.earnings";
		$this->module_icon                   = "fa fa-money";
		
		$this->BaseModel                     = $OrdersModel;
		$this->UserModel                     = $user_model;
		$this->OrdersModel                   = $OrdersModel;
		$this->OrdersProductModel            = $order_product;
		$this->NotificationService           = $notification_service;

		$this->order_invoice_base_pdf_path   = base_path().config('app.project.pdf_path.order_invoice');
		$this->order_invoice_public_pdf_path = url('/').config('app.project.pdf_path.order_invoice');
	}

	/*
    | Function  : Get the listing of all the completed order data
    | Author    : Deepak Arvind Salunke
    | Date      : 08/06/2018
    | Output    : Show the listing of all the completed order data
    */

	public function index()
	{
		if(Session::exists('back_url'))
		{
			Session::forget('back_url');
			Session::put('back_url', $this->module_url_path);
		}
		else
		{
			Session::put('back_url', $this->module_url_path);
		}

		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);

	} // end past


	/*
    | Function  : Get all the listing data required for completed orders after page is load
    | Author    : Deepak Arvind Salunke
    | Date      : 08/06/2018
    | Output    : Show all the listing data required for completed orders after page is load
    */

	public function load_data(Request $request)
	{
		$order_by_name = $order_by_first_name = $order_by_last_name = $supplier_name = $supplier_first_name = $supplier_last_name = $order_status = '';
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

		$obj_orders = $obj_orders->select(['id', 'order_id','user_id', 'order_fname', 'order_lname', 'order_email', 'order_payment_method', 'status', 'created_at','order_cost'])
								 ->where(function($query){
                                    $query->where('status', '5');
                                 })
								 ->with(['order_products' => function($query){
								 	$query->select('id', 'order_id', 'product_id');
								 	$query->selectRaw('sum(product_final_price) as total_amount');
								 	$query->selectRaw('sum(product_price) as supplier_amount');
								 	$query->groupBy('order_id');
								 }])
								 ->orderBy('id','DESC');
						
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

					$current_status  = '<a class="btn btn-xs btn-success" title="'.$order_status.'" >'.$order_status.'</a>';

					$order_by_name   = $order_by_first_name.' '.$order_by_last_name;

					$total_amount    = isset($data->order_cost) ? $data->order_cost : '0';
					$supplier_amount = isset($data->order_products[0]->supplier_amount) ? $data->order_products[0]->supplier_amount : '0';

					$earnings = $total_amount - $supplier_amount;

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->order_id     	      = isset($data->order_id) ? $data->order_id : 'NA';				
					$build_result->data[$key]->order_by_name       = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->payment_method      = $payment_method;
					$build_result->data[$key]->total               = $total_amount;
					$build_result->data[$key]->supplier_amount     = number_format(get_supplier_earning($data->order_id),2);
					$build_result->data[$key]->earnings            = number_format(get_admin_earning($data->order_id),2);
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

					$build_result->data[$key]->build_status_check  = $current_status;
					$build_result->data[$key]->built_action_button = $action_button;
				}
			}

			return response()->json($build_result);
		}
	} // end load_data


	/*
    | Function  : Get order data for selected order
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : Show order data for selected order
    */

	public function view($enc_id)
	{
		$id = base64_decode($enc_id);
		$sub_total = 0;
		$total = 0;
		$insurance_product = 0;
		$arr_orders = [];
		$arr_price  = [];
		$obj_orders = $this->BaseModel->where('id',$id)
									  ->with('order_products', 'order_products.supplier_details', 'order_giftcard', 'order_wallet')	
									  ->first();
		if($obj_orders)
		{
			$arr_orders = $obj_orders->toArray();	
		}
		//dd($arr_orders);

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
		
		$this->arr_view_data['arr_orders']                    = $arr_orders;
		$this->arr_view_data['arr_price']                     = $arr_price;
		$this->arr_view_data['id']                            = $id;
		$this->arr_view_data['page_title']                    = "View ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']            = "icon-home2";
		$this->arr_view_data['parent_module_title']           = "Dashboard";
		$this->arr_view_data['parent_module_url']             = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']                  = str_plural($this->module_title);
		$this->arr_view_data['module_icon']                   = $this->module_icon;
		$this->arr_view_data['module_icon']                   = $this->module_icon;
		$this->arr_view_data['module_url']                    = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']              = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']              = 'View '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']               = 'fa fa-eye';
		$this->arr_view_data['module_url_path']               = $this->module_url_path;

		$this->arr_view_data['order_invoice_base_pdf_path']   = $this->order_invoice_base_pdf_path;
		$this->arr_view_data['order_invoice_public_pdf_path'] = $this->order_invoice_public_pdf_path;

		return view($this->module_view_folder.'.view',$this->arr_view_data);
	} // end view

	public function order_product($enc_id,$order_id)
	{
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

		$this->arr_view_data['order_id']			= $order_id;
		$this->arr_view_data['arr_product']   		= $arr_product;
		$this->arr_view_data['page_title']          = "View Order Product";
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']        = str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'View Order';
		$this->arr_view_data['sub_module_icon']     = 'fa fa-eye';
		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		return view($this->module_view_folder.'.order_product_view',$this->arr_view_data);
	} // end order_product

}