<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\OrdersModel;

Use Validator;
Use Session;
use DataTables;
use Excel;
use DB;

class OrdersReportController extends Controller
{
	use MultiActionTrait;
	public function __construct(OrdersModel $orders_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/reports/orders";
		$this->module_title       = "Orders Report";
		$this->module_view_folder = "admin.reports.orders";
		$this->module_icon        = "fa fa-file-text";

		$this->OrdersModel        = $orders_model;
		$this->BaseModel          = $orders_model;
	}


	/*
    | Function  : Get all the orders data
    | Author    : Deepak Arvind Salunke
    | Date      : 08/06/2018
    | Output    : Show all orders listing
    */

	public function index()
	{
		$this->arr_view_data['page_title']            = str_plural($this->module_title);
		$this->arr_view_data['parent_module_icon']    = "icon-home2";
		$this->arr_view_data['parent_module_title']   = "Dashboard";
		$this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
		$this->arr_view_data['module_icon']           = $this->module_icon;
		$this->arr_view_data['module_title']          = str_plural($this->module_title);

		$this->arr_view_data['module_url_path']       = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	} // end index


	public function load_data(Request $request)
	{
		$build_verification_btn = $btn_class = $order_status = "";

		$arr_search_column      = $request->input('column_filter');
		$start_date             = $arr_search_column['start_date'];
		$end_date               = $arr_search_column['end_date'];

		$obj_reports            = $this->BaseModel;

		if(isset($arr_search_column['q_order_id']) && $arr_search_column['q_order_id']!="")
		{
			$obj_reports = $obj_reports->where('order_id', 'LIKE', "%".$arr_search_column['q_order_id']."%");	
		}

		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$search_name = $arr_search_column['q_user_name'];
			$obj_reports = $obj_reports->where(function($query) use ($search_name){
		                                	$query->where('order_fname', 'LIKE', "%".$search_name."%");
		                                	$query->orWhere('order_lname', 'LIKE', "%".$search_name."%");
		                                	$query->orwhere(DB::raw('CONCAT_WS(" ", order_fname, order_lname)'), 'LIKE', "%".$search_name."%");
	                                  	});	
		}


		// dates filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_reports = $obj_reports->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}


		$obj_reports = $obj_reports->select(['id', 'order_id','user_id', 'order_fname', 'order_lname', 'order_email', 'order_payment_method', 'status', 'created_at'])
								   ->where(function($query){
                                    	$query->where('status', '<>','0');
                                 	})
								   ->with(['order_products' => function($query){
									 	$query->select('id', 'order_id', 'product_id');
									 	$query->selectRaw('sum(product_final_price) as total_amount');
									 	$query->groupBy('order_id');
								 	}])
								   ->orderBy('id','DESC');

		if($obj_reports)
		{
			$json_result  = DataTables::of($obj_reports)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
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
						$btn_class = 'btn-info';
					}
					else if($status == '2')
					{
						$order_status = 'Confirmed';
						$btn_class = 'btn-info';
					}
					else if($status == '3')
					{
						$order_status = 'Dispatched';
						$btn_class = 'btn-info';
					}
					else if($status == '4')
					{
						$order_status = 'Delivered';
						$btn_class = 'btn-info';
					}
					elseif($status == '5')
					{
						$order_status = 'Completed';
						$btn_class = 'btn-info';
					}
					elseif($status == '6')
					{
						$order_status = 'Cancelled';
						$btn_class = 'btn-info';
					}

					$current_status = '<a class="btn btn-xs '.$btn_class.'" title="'.$order_status.'" >'.$order_status.'</a>';

					$order_by_name = $order_by_first_name.' '.$order_by_last_name;

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->order_id     	   = isset($data->order_id) ? $data->order_id : 'NA';				
					$build_result->data[$key]->order_by_name       = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->payment_method      = $payment_method;
					$build_result->data[$key]->total               = isset($data->order_products[0]->total_amount) ? $data->order_products[0]->total_amount : 'NA';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

					$build_result->data[$key]->build_status_check  = $current_status;

				}
			}
			return response()->json($build_result);
		}
	}

	/*
    | Function  : Get all the orders data as per filter and generate csv
    | Author    : Deepak Arvind Salunke
    | Date      : 11/05/2018
    | Output    : export to csv
    */

	public function export_csv(Request $request)
	{
		$start_date = $request->input('start_date');
		$end_date   = $request->input('end_date');
		$data       = array();

		$obj_reports = $this->BaseModel->where(function($query){
	                                    	$query->where('status', '<>','0');
	                                 	})
									   ->with(['order_products' => function($query){
										 	$query->select('id', 'order_id', 'product_id');
										 	$query->selectRaw('sum(product_final_price) as total_amount');
										 	$query->groupBy('order_id');
									 	}])
									   ->orderBy('id','DESC');

		// dates filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_reports = $obj_reports->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}

        if($obj_reports)
        {
            $arr_reports = $obj_reports->get()->toArray();

            foreach ($arr_reports as $key => $reports) 
            {
                $data['Sr. No.']             = ($key+1);
                $data['Order ID']            = isset($reports['order_id'])? $reports['order_id']:'NA';
                
                $fname                       = isset($reports['order_fname'])? $reports['order_fname']:'NA';
                $lname                       = isset($reports['order_lname'])? $reports['order_lname']:'NA';

                $data['Customer Name']       = ucfirst($fname).' '.ucfirst($lname);
                $data['Customer Email']      = isset($reports['order_email'])? $reports['order_email']:'NA';
                $data['Customer Contact No'] = isset($reports['order_contact_no'])? $reports['order_contact_no']:'NA';
                
                $order_flat_no               = isset($reports['order_flat_no'])? $reports['order_flat_no']:'';
                $order_building_name         = isset($reports['order_building_name'])? $reports['order_building_name']:'';
                $order_address               = isset($reports['order_address'])? $reports['order_address']:'';
                $order_city                  = isset($reports['order_city'])? $reports['order_city']:'';
                $order_state                 = isset($reports['order_state'])? $reports['order_state']:'';
                $order_country               = isset($reports['order_country'])? $reports['order_country']:'';

                $data['Customer Address']    = $order_flat_no.', '.$order_building_name.', '.$order_address.', '.$order_city.', '.$order_state.', '.$order_country;
                $data['Pincode']             = isset($reports['order_post_code'])? $reports['order_post_code']:'';
                
                $order_payment_method        = isset($reports['order_payment_method'])? $reports['order_payment_method']:'';
                if($order_payment_method == 1)
                {
                	$data['Payment Method']    = 'Online';
                }
                elseif($order_payment_method == 2)
                {
                	$data['Payment Method']    = 'Wire Transfer';
                }
                
                $data['Sub-Total Price (INR)'] = isset($reports['order_subtotal'])? $reports['order_subtotal']:'NA';
                $data['Total Price (INR)']     = isset($reports['order_products']['0']['total_amount'])? $reports['order_products']['0']['total_amount']:'NA';

                $status = isset($reports['status'])? $reports['status']:'';
                if($status == 1)
                {
                	$data['Status'] 		= 'In-Process';
                }
                elseif($status == 2)
                {
                	$data['Status'] 		= 'Confirmed';
                }
                elseif($status == 3)
                {
                	$data['Status'] 		= 'Dispatched';
                }
                elseif($status == 4)
                {
                	$data['Status'] 		= 'Delivered';
                }
                elseif($status == 5)
                {
                	$data['Status'] 		= 'Completed';
                }
                elseif($status == 6)
                {
                	$data['Status'] 		= 'Cancelled';
                }


                $data['Order On']            = isset($reports['created_at'])? $reports['created_at'] :'';

                array_push($this->arr_view_data, $data);    
            }
        }

        $data = $this->arr_view_data;
        $type = 'CSV';

        return Excel::create('Orders', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Orders Reports');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
            	  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Orders Reports');

            $excel->sheet('Orders', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

	} // end export_csv

}
