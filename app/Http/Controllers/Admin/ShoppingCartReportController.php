<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\CartProductModel;

Use Validator;
Use Session;
use DataTables;
use Excel;
use DB;

class ShoppingCartReportController extends Controller
{
	use MultiActionTrait;
	public function __construct(
									CartProductModel    $cartproduct_model
								)
	{
		$this->arr_view_data       = [];
		$this->admin_panel_slug    = config('app.project.admin_panel_slug');
		$this->admin_url_path      = url(config('app.project.admin_panel_slug'));
		$this->module_url_path     = $this->admin_url_path."/reports/shopping-cart";
		$this->module_title        = "Shopping Cart Report";
		$this->module_view_folder  = "admin.reports.shopping_cart";
		$this->module_icon         = "fa fa-file-text";

		$this->BaseModel           = $cartproduct_model;
	}


	/*
    | Function  : Get all the shopping-cart data
    | Author    : Deepak Arvind Salunke
    | Date      : 08/06/2018
    | Output    : Show all shopping-cart listing
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
		$arr_search_column      = $request->input('column_filter');

		$obj_reports = $this->BaseModel;
		
		// search user_name
		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$username_search = $arr_search_column['q_user_name'];
			$obj_reports = $obj_reports->whereHas('cart.user_details', function($query) use($username_search){
				$query->where('first_name', 'LIKE', "%".$username_search."%");
				$query->orWhere('last_name', 'LIKE', "%".$username_search."%");
				$query->orwhere(DB::raw('CONCAT_WS(" ", first_name, last_name)'), 'LIKE', "%".$username_search."%");
			});		
		}

		// search email
		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$email_search = $arr_search_column['q_email'];
			$obj_reports = $obj_reports->whereHas('cart.user_details', function($query) use($email_search){
				$query->where('email', 'LIKE', "%".$email_search."%");
			});		
		}

		$obj_reports = $obj_reports->select(['id', 'cart_id', 'product_id', 'product_quantity','name_on_product','created_at', \DB::raw('sum(product_quantity) as quantity')])
									->with(['cart.user_details' => function($query)
									{
										$query->select('id','first_name','last_name', 'email');
									}])
									->groupBy('cart_id');

		if($obj_reports)
		{
			$json_result  = DataTables::of($obj_reports)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$id         = isset($data->id) ? base64_encode($data->id) : '';
					$first_name = isset($data->cart->user_details->first_name) ? $data->cart->user_details->first_name : '';
					$last_name  = isset($data->cart->user_details->last_name) ? $data->cart->user_details->last_name : '';

					$build_result->data[$key]->id         = $id;
					$build_result->data[$key]->user_name  = $first_name.' '.$last_name;
					$build_result->data[$key]->email      = isset($data->cart->user_details->email) ? $data->cart->user_details->email : '';
					$build_result->data[$key]->quantity   = isset($data->quantity) ? $data->quantity : '';
					$build_result->data[$key]->created_at = isset($data->created_at)? get_formated_created_date($data->created_at) : '';
				}
			}
			return response()->json($build_result);
		}
	}

	/*
    | Function  : Get all the shopping-cart data as per filter and generate csv
    | Author    : Deepak Arvind Salunke
    | Date      : 11/05/2018
    | Output    : export to csv
    */

	public function export_csv(Request $request)
	{
		$start_date = $request->input('start_date');
		$end_date   = $request->input('end_date');
		$data       = array();

		$obj_reports = $this->BaseModel->select(['id', 'cart_id', 'product_id', 'product_quantity','name_on_product','created_at', \DB::raw('sum(product_quantity) as quantity'), \DB::raw('count(product_quantity) as no_of_products')])
										->with(['cart.user_details' => function($query)
										{
											$query->select('id','first_name','last_name', 'email');
										}])
										->groupBy('cart_id');

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
                $data['Sr. No.']        = ($key+1);
                
                $fname                  = isset($reports['cart']['user_details']['first_name'])? $reports['cart']['user_details']['first_name'] : 'NA';
                $lname                  = isset($reports['cart']['user_details']['last_name'])? $reports['cart']['user_details']['last_name'] : 'NA';

                $data['Customer Name']  = ucfirst($fname).' '.ucfirst($lname);
                $data['Customer Email'] = isset($reports['cart']['user_details']['email'])? $reports['cart']['user_details']['email']:'NA';
                $data['No of Products'] = isset($reports['no_of_products']) ? $reports['no_of_products'] : 'NA';
                $data['Quantity']       = isset($reports['quantity']) ? $reports['quantity'] : 'NA';

                array_push($this->arr_view_data, $data);    
            }
        }

        $data = $this->arr_view_data;
        $type = 'CSV';

        return Excel::create('Shopping Cart', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Shopping Cart Reports');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
            	  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Shopping Cart Reports');

            $excel->sheet('Shopping Cart', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

	} // end export_csv

}
