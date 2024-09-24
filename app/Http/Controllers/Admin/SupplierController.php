<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\SupplierModel;
use App\Common\Services\NotificationService;

Use Validator;
Use Session;

use DataTables;

class SupplierController extends Controller
{
	use MultiActionTrait;
	public function __construct(
		                        SupplierModel        $supplier_model,
								NotificationService  $notification_service
							   )
	{
		$this->arr_view_data       = [];
		$this->admin_panel_slug    = config('app.project.admin_panel_slug');
		$this->admin_url_path      = url(config('app.project.admin_panel_slug'));
		$this->module_url_path     = $this->admin_url_path."/user/suppliers";
		$this->module_title        = "Supplier";
		$this->module_view_folder  = "admin.suppliers";
		$this->module_icon         = "fa fa-user";

		$this->SupplierModel       = $supplier_model;

		$this->BaseModel           = $supplier_model;
		$this->NotificationService = $notification_service;
		
		$this->supplier_profile_image_base_img_path   = base_path().config('app.project.img_path.supplier_profile_image');
        $this->supplier_profile_image_public_img_path = url('/').config('app.project.img_path.supplier_profile_image');
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

		$obj_supplier = $obj_supplier->select(['id', 'first_name', 'last_name','email','admin_commission','is_admin_verified', 'status', 'created_at']);

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
						onclick="return confirm_action(this,event,\'Do you really want to activate this supplier ?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this supplier ?\')" >Active</a>';
					}

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";

					if($data->is_admin_verified != null && $data->is_admin_verified == "0")
					{   
						$build_verification_btn = '<a class="btn btn-xs btn-danger" title="Block" href="'.$this->module_url_path.'/verify/'.base64_encode($data->id).'" 
						onclick="return confirm_action(this,event,\'Do you really want to verify this supplier?\')" >No</a>';
					}
					elseif($data->is_admin_verified != null && $data->is_admin_verified == "1")
					{
						$build_verification_btn = '<a class="btn btn-xs btn-success" href="javascript:void(0)">Yes</a>';
					}

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-eye' ></i></a>";

					$action_button = $built_view_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->first_name          = isset($data->first_name)? $data->first_name :'';				
					$build_result->data[$key]->last_name           = isset($data->last_name)? $data->last_name :'';				
					$build_result->data[$key]->email               = isset($data->email)? $data->email :'';				
					$build_result->data[$key]->admin_commission    = isset($data->admin_commission) && !empty($data->admin_commission) ? $data->admin_commission :'Not Set';				
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';
					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->admin_verification  = $build_verification_btn;
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
			
			$arr_supplier = [];

			$obj_supplier = $this->BaseModel
											->with(['business_details' => function($query){
												$query->select('supplier_id','business_name','business_reg_no','pan_no','email','country_phone_code_id','mobile_number');
											}])
											->with(['financial_details' => function($query){
												$query->select('user_id','bank_name','branch','account_holder_name','account_number','ifsc_code')
												->where('user_type', '3');
											}])
			->where('id',$id)
											->first();
			if($obj_supplier)
			{
				$arr_supplier = $obj_supplier->toArray();	
			}
			
			if(isset($arr_supplier['country_phone_code_id']) && !empty($arr_supplier['country_phone_code_id']))
			{
				$arr_phone_code = get_phonecode($arr_supplier['country_phone_code_id']);
				$phone_code = isset($arr_phone_code['phonecode']) ? $arr_phone_code['phonecode'] : '';
			}

			if(isset($arr_supplier['business_details']['country_phone_code_id']) && !empty($arr_supplier['business_details']['country_phone_code_id']))
			{
				$arr_business_phone_code = get_phonecode($arr_supplier['business_details']['country_phone_code_id']);

				$business_phone_code = isset($arr_business_phone_code['phonecode']) ? $arr_business_phone_code['phonecode'] : '';
			}
			$this->arr_view_data['supplier_profile_image_base_img_path']     = $this->supplier_profile_image_base_img_path;
			$this->arr_view_data['supplier_profile_image_public_img_path']   = $this->supplier_profile_image_public_img_path;

			$this->arr_view_data['phone_code']          = $phone_code;
			$this->arr_view_data['business_phone_code'] = $business_phone_code;
			$this->arr_view_data['arr_supplier']        = $arr_supplier;
			// dd($arr_supplier);
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
			$this->arr_view_data['sub_module_icon']     = 'fa fa-eye';

			$this->arr_view_data['module_url_path']     = $this->module_url_path;

			return view($this->module_view_folder.'.view',$this->arr_view_data);
		}
		else
		{	
			Session::flash('error', 'Something went to wrong');
			return redirect()->back();
		}
	}

	public function verify($enc_id = false)
	{
		if($enc_id != false)
		{
			$id = base64_decode($enc_id);
			$status = $this->BaseModel->where('id',$id)->update(['is_admin_verified' => 2]);
			if($status)
			{
				Session::flash('success', $this->module_title.' verification done successfully.');
				return redirect()->back();
			}
			else
			{
				Session::flash('error', 'Error while verifying '.$this->module_title);
				return redirect()->back();
			}
		}
		else
		{
			Session::flash('error', 'Error while verifying '.$this->module_title);
			return redirect()->back();
		}
	}

	public function commission_store(Request $request)
	{
		$arr_rules      = $arr_occassion = array();
		$status         = false;

		$arr_rules['commission']  =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$commission = $request->input('commission', null);
		$enc_id = $request->input('enc_id', null);

		if($enc_id != null)
		{
			$id = base64_decode($enc_id);
			$status = $this->BaseModel->where('id',$id)->update(['admin_commission' => $commission]);
			if($status)
			{
				$admin_details = login_user_details('admin');
       
       			$admin_fname = isset($admin_details->first_name) && !empty($admin_details->first_name) ? $admin_details->first_name : 'Admin';

				$arr_noti['receiver_user_id']       =  $id;  //receiver user id
				$arr_noti['receiver_user_type_id']  =  '3';
				$arr_noti['admin_name']             =  $admin_fname or '';
				$arr_noti['commission']             =  $commission;
				$arr_noti['url']                    =  "account_setting/financial";

			$status = $this->NotificationService->store_set_website_commission_notification($arr_noti);

				Session::flash('success', 'Website commission saved successfully.');
				return redirect($this->module_url_path);
			}
			else
			{
				Session::flash('error', 'Error while saving website commission');
				return redirect()->back();
			}
		}
		else
		{
			Session::flash('error', 'Error while saving website commission');
			return redirect()->back();
		}

				

		
		
	
	}

}
