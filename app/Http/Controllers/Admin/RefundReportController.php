<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\UserWalletModel;

Use Validator;
Use Session;
use DataTables;
use Excel;
use DB;

class RefundReportController extends Controller
{
	use MultiActionTrait;
	public function __construct(UserWalletModel $user_wallet_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/reports/refund";
		$this->module_title       = "Refund Report";
		$this->module_view_folder = "admin.reports.refund";
		$this->module_icon        = "fa fa-file-text";

		$this->UserWalletModel    = $user_wallet_model;
		$this->BaseModel          = $user_wallet_model;
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
			$obj_reports = $obj_reports->whereHas('order_details', function($query) use($search_name){
											$query->where('order_fname', 'LIKE', "%".$search_name."%");
									        $query->orWhere('order_lname', 'LIKE', "%".$search_name."%");
									        $query->orwhere(DB::raw('CONCAT_WS(" ", order_fname, order_lname)'), 'LIKE', "%".$search_name."%");
										});
		}

		if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
		{
			$search_name = $arr_search_column['q_product_name'];
			$obj_reports = $obj_reports->whereHas('product_details', function($query) use($search_name){
											$query->where('product_name', 'LIKE', "%".$search_name."%");
										});
		}


		// dates filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_reports = $obj_reports->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}


		$obj_reports = $obj_reports->where('type','1')
								   ->where('transaction_status','1')
								   ->where('amount_credited', '!=', '0')
								   ->with(['order_details' => function($query){
									 	$query->select('id', 'order_id', 'order_fname','order_lname','order_email','order_contact_no');
									}])
								   ->with(['product_details' => function($query){
									 	$query->select('id', 'uid', 'product_name','quantity','final_price');
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
					$id                  = isset($data->id)? base64_encode($data->id) :'';
					$order_by_first_name = isset($data->order_details->order_fname) ? ucfirst($data->order_details->order_fname) : '';
					$order_by_last_name  = isset($data->order_details->order_lname) ? ucfirst($data->order_details->order_lname) : '';
					$order_by_name       = $order_by_first_name.' '.$order_by_last_name;

					$build_result->data[$key]->id            = $id;
					$build_result->data[$key]->order_id      = isset($data->order_id) ? $data->order_id : 'NA';
					$build_result->data[$key]->order_by_name = isset($order_by_name) && !empty($order_by_name) ? $order_by_name : 'NA';
					$build_result->data[$key]->product_name  = isset($data->product_details->product_name)? $data->product_details->product_name : '';
					$build_result->data[$key]->quantity      = isset($data->product_details->quantity)? $data->product_details->quantity : '';
					$build_result->data[$key]->total_price   = isset($data->product_details->final_price) ? $data->product_details->final_price : '';
					$build_result->data[$key]->refund_amount = isset($data->amount_credited) ? $data->amount_credited : '';
					$build_result->data[$key]->created_at    = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';
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

		$obj_reports = $this->BaseModel->where('type','1')
									   ->where('transaction_status','1')
									   ->where('amount_credited', '!=', '0')
									   ->with(['order_details' => function($query){
										 	$query->select('id', 'order_id', 'order_fname','order_lname','order_email','order_contact_no');
										}])
									   ->with(['product_details' => function($query){
										 	$query->select('id', 'uid', 'product_name','quantity','final_price');
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
                $fname                       = isset($reports['order_details']['order_fname'])? $reports['order_details']['order_fname']:'NA';
                $lname                       = isset($reports['order_details']['order_lname'])? $reports['order_details']['order_lname']:'NA';
                $data['Customer Name']       = ucfirst($fname).' '.ucfirst($lname);
                $data['Customer Email']      = isset($reports['order_details']['order_email'])? $reports['order_details']['order_email']:'NA';
                $data['Customer Contact No'] = isset($reports['order_details']['order_contact_no'])? $reports['order_details']['order_contact_no']:'NA';
                $data['Product Name']        = isset($reports['product_details']['product_name'])? $reports['product_details']['product_name']:'NA';
                $data['Quantity']            = isset($reports['product_details']['quantity'])? $reports['product_details']['quantity']:'NA';
                $data['Paid Amount (INR)']   = isset($reports['product_details']['final_price'])? $reports['product_details']['final_price']:'NA';
                $data['Refund Amount (INR)'] = isset($reports['amount_credited'])? $reports['amount_credited']:'NA';
                $data['Refund On']           = isset($reports['created_at'])? $reports['created_at'] :'';

                array_push($this->arr_view_data, $data);    
            }
        }

        $data = $this->arr_view_data;
        $type = 'CSV';

        return Excel::create('Refund', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Refund Reports');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
            	  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Refund Reports');

            $excel->sheet('Refund', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

	} // end export_csv

}
