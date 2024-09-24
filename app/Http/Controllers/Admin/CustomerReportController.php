<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\UserModel;

Use Validator;
Use Session;
use DataTables;
use Excel;

class CustomerReportController extends Controller
{
	use MultiActionTrait;
	public function __construct(UserModel $user_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/reports/users";
		$this->module_title       = "Customers Report";
		$this->module_view_folder = "admin.reports.users";
		$this->module_icon        = "fa fa-file-text";

		$this->UserModel          = $user_model;

		$this->BaseModel          = $user_model;
		
		$this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');
	}


	/*
    | Function  : Get all the customers data
    | Author    : Deepak Arvind Salunke
    | Date      : 11/05/2018
    | Output    : Show all customers listing
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
		
		return view($this->module_view_folder.'.customers',$this->arr_view_data);
	} // end index


	public function load_data(Request $request)
	{
		$build_verification_btn = "";

		$arr_search_column      = $request->input('column_filter');

		$start_date = $arr_search_column['start_date'];
		$end_date = $arr_search_column['end_date'];

		$obj_supplier = $this->BaseModel;
		if(isset($arr_search_column['q_first_name']) && $arr_search_column['q_first_name']!="")
		{
			$obj_supplier = $obj_supplier->where('first_name', 'LIKE', "%".$arr_search_column['q_first_name']."%");	
		}

		if(isset($arr_search_column['q_last_name']) && $arr_search_column['q_last_name']!="")
		{
			$obj_supplier = $obj_supplier->where('last_name', 'LIKE', "%".$arr_search_column['q_last_name']."%");	
		}

		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$obj_supplier = $obj_supplier->where('email', 'LIKE', "%".$arr_search_column['q_email']."%");	
		}


		// serach filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_supplier = $obj_supplier->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}


		$obj_supplier = $obj_supplier->select(['id', 'first_name', 'last_name', 'email', 'status', 'created_at']);

		if($obj_supplier)
		{
			$json_result  = DataTables::of($obj_supplier)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_view_href   = $this->module_url_path.'/view/'.base64_encode($data->id);

				$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->status != null && $data->status == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Block" href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" 
						onclick="return confirm_action(this,event,\'Do you really want to activate this customer?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this customer?\')" >Active</a>';
					}

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";


					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";

					$action_button = $built_view_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->first_name          = isset($data->first_name)? $data->first_name :'';
					$build_result->data[$key]->last_name           = isset($data->last_name)? $data->last_name :'';
					$build_result->data[$key]->email           	   = isset($data->email)? $data->email :'';
					$build_result->data[$key]->admin_commission    = isset($data->admin_commission) && !empty($data->admin_commission) ? $data->admin_commission :'Not Set';
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';
					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

	/*
    | Function  : Get all the customers data as per filter and generate csv
    | Author    : Deepak Arvind Salunke
    | Date      : 11/05/2018
    | Output    : export to csv
    */

	public function export_csv(Request $request)
	{
		$start_date = $request->input('start_date');
		$end_date = $request->input('end_date');
		$data = array();

		$obj_users  = $this->UserModel;

		// serach filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_users = $obj_users->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}

        if($obj_users)
        {
            $arr_user = $obj_users->get()->toArray();

            foreach ($arr_user as $key => $user) 
            {
                $data['Sr. No.']            = ($key+1);
                $data['User Name']          = $user['first_name'].' '.$user['last_name'];
                $data['Email']  			= isset($user['email'])? $user['email']:'NA';
                
                $gender = isset($user['gender'])? $user['gender']:'';
                if($gender == 1)
                {
                	$data['Gender'] 		= 'Male';
                }
                else
                {
                	$data['Gender'] 		= 'Female';
                }

                $data['Address'] 			= isset($user['address'])? $user['address']:'NA';
                $data['Mobile No']  		= isset($user['mobile_number'])? $user['mobile_number']:'NA';

                $status = isset($user['status'])? $user['status']:'';
                if($status == 1)
                {
                	$data['Status'] 		= 'Active';
                }
                else
                {
                	$data['Status'] 		= 'Blocked';
                }

                $data['Registered On']      = isset($user['created_at'])? $user['created_at'] :'';

                array_push($this->arr_view_data, $data);    
            }
        }

        $data = $this->arr_view_data;
        $type = 'CSV';

        return Excel::create('Users', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Customers Reports');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
            	  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Customers Reports');

            $excel->sheet('Customers', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

	} // end export_csv

}
