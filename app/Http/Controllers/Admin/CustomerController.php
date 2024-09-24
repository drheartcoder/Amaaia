<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\UserModel;
use App\Models\BankDetailsModel;

Use Validator;
Use Session;

use DataTables;

class CustomerController extends Controller
{
	use MultiActionTrait;
	public function __construct(UserModel $user_model, BankDetailsModel $bank_details_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/user/customers";
		$this->module_title       = "Customer";
		$this->module_view_folder = "admin.customers";
		$this->module_icon        = "fa fa-user";

		$this->UserModel        = $user_model;
		$this->BankDetailsModel = $bank_details_model;

		$this->BaseModel          = $user_model;
		
		$this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');
	}

	public function index()
	{
		$this->arr_view_data['page_title']            = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['parent_module_icon']    = "icon-home2";
		$this->arr_view_data['parent_module_title']   = "Dashboard";
		$this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
		$this->arr_view_data['module_icon']           = $this->module_icon;
		$this->arr_view_data['module_title']          = "Manage ".str_plural($this->module_title);

		$this->arr_view_data['module_url_path']       = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function load_data(Request $request)
	{
		$build_verification_btn = "";

		$arr_search_column      = $request->input('column_filter');

		$obj_supplier = $this->BaseModel;
		if(isset($arr_search_column['q_first_name']) && $arr_search_column['q_first_name']!="")
		{
			$obj_supplier = $obj_supplier->where('first_name', 'LIKE', "%".$arr_search_column['q_first_name']."%");	
		}

		if(isset($arr_search_column['q_last_name']) && $arr_search_column['q_last_name']!="")
		{
			$obj_supplier = $obj_supplier->where('last_name', 'LIKE', "%".$arr_search_column['q_last_name']."%");	
		}

		$obj_supplier = $obj_supplier->select(['id', 'first_name', 'last_name','email', 'status', 'created_at']);

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
					$build_result->data[$key]->email           = isset($data->email)? $data->email :'';				
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

	public function view($enc_id = false)
	{	
		$phone_code = $business_phone_code = "";

		if($enc_id != false)
		{
			$id = base64_decode($enc_id);
			
			$arr_customer = [];
			$arr_bank_details = [];

			$obj_customer = $this->BaseModel->where('id',$id)->first();
			
			if($obj_customer)
			{
				$arr_customer = $obj_customer->toArray();	
			}
			
			if(isset($arr_customer['country_phone_code_id']) && !empty($arr_customer['country_phone_code_id']))
			{
				$arr_phone_code = get_phonecode($arr_customer['country_phone_code_id']);
				$phone_code = isset($arr_phone_code['phonecode']) ? $arr_phone_code['phonecode'] : '';
			}

			$obj_bank_details = $this->BankDetailsModel->where(['user_id'=>$id, 'user_type'=>'2'])->first();
			if($obj_bank_details)
			{
				$arr_bank_details = $obj_bank_details->toArray();
			}

			$this->arr_view_data['user_profile_image_base_path']     = $this->user_profile_image_base_path;
			$this->arr_view_data['user_profile_image_public_path']   = $this->user_profile_image_public_path;

			$this->arr_view_data['phone_code']          = $phone_code;
			$this->arr_view_data['business_phone_code'] = $business_phone_code;
			$this->arr_view_data['arr_customer']        = $arr_customer;
			$this->arr_view_data['enc_id']              = $enc_id;
			$this->arr_view_data['page_title']          = "View ".str_singular($this->module_title).' Details';
			$this->arr_view_data['parent_module_icon']  = "icon-home2";
			$this->arr_view_data['parent_module_title'] = "Dashboard";
			$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['module_title']        = str_plural($this->module_title);
			$this->arr_view_data['module_icon']         = $this->module_icon;
			$this->arr_view_data['module_icon']         = $this->module_icon;
			$this->arr_view_data['module_url']          = $this->module_url_path;
			$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']    = 'View '.str_singular($this->module_title).' Details';
			$this->arr_view_data['sub_module_icon']  = 'fa fa-eye';
			$this->arr_view_data['arr_bank_details'] = $arr_bank_details;

			$this->arr_view_data['module_url_path']     = $this->module_url_path;

			return view($this->module_view_folder.'.view',$this->arr_view_data);
		}
		else
		{	
			Session::flash('error', 'Something went to wrong');
			return redirect()->back();
		}
	}
}
