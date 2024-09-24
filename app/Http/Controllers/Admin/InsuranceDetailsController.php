<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InsuranceDetailsModel;
use App\Common\Traits\MultiActionTrait;
use Validator;
use DataTables;
use Session;

class InsuranceDetailsController extends Controller
{
	use MultiActionTrait;	
	public function __construct(
		InsuranceDetailsModel $insurance_details_model
		)
	{
		$this->arr_data           = [];
		$this->BaseModel          = $insurance_details_model;
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/insurance_details";
		$this->module_title       = "Insurance Details";
		$this->module_view_folder = "admin.insurance_details";
		$this->module_icon        = "fa fa-shield";

	}

	public function index()
	{

		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['parent_module_url']    = $this->admin_url_path;

		$this->arr_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_data['module_title'] = "Manage ".str_plural($this->module_title);
		$this->arr_data['module_icon']  = $this->module_icon;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url_path']     = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']       = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		return view($this->module_view_folder.'.index',$this->arr_data);

	}

	public function create()
	{
		$this->arr_data['page_title']          = "Add ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['parent_module_url']   = $this->admin_url_path;
		$this->arr_data['module_title']        = str_plural($this->module_title);
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url']          = $this->module_url_path.'/manage';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']     = 'fa fa-plus';

		return view($this->module_view_folder.'.create',$this->arr_data);
	}

	public function store(Request $request)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['company_name']     = "required";
		$arr_rules['insurance_amount'] = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$company_name     = $request->input('company_name', null);
		$insurance_amount = $request->input('insurance_amount', null);
		$description      = $request->input('description', null);

		$dose_exist = $this->BaseModel->where('company_name', '=', $company_name)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This insurance company is already added.');
			return redirect()->back();
		}

		$status = $this->BaseModel->create(array(
			'company_name'=> $company_name,
			'price'=> $insurance_amount,
			'description'=>$description
			));		

		if($status)
		{
			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path.'/manage');
		}

		Session::flash('error', 'Error while adding '.$this->module_title.'.');
		return redirect()->back();

	}

	public function edit($enc_id)
	{
		$id = base64_decode($enc_id);
		$arr_company = [];

		$obj_company = $this->BaseModel->where('id',$id)->select('company_name', 'price', 'description')->first();
		
		if($obj_company)
		{
			$arr_company = $obj_company->toArray();	
		}

		$this->arr_data['arr_company']           = $arr_company;
		$this->arr_data['id']                  = $enc_id;
		$this->arr_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['parent_module_url']    = $this->admin_url_path;
		$this->arr_data['module_title']        = str_plural($this->module_title);
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url']     = $this->module_url_path.'/manage';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']     = 'fa fa-pencil-square-o';

		return view($this->module_view_folder.'.edit',$this->arr_data);
	}


	public function update(Request $request, $enc_id)
	{
		$arr_rules      = array();
		$status         = false;
		$id = base64_decode($enc_id);

		$arr_rules['company_name']     = "required";
		$arr_rules['insurance_amount'] = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$company_name     = $request->input('company_name', null);
		$insurance_amount = $request->input('insurance_amount', null);
		$description      = $request->input('description', null);

		$obj_company = $this->BaseModel->where('id',$id)->select('company_name', 'price', 'description')->first();

		$dose_exist = $this->BaseModel->where('company_name', '=', $company_name)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This insurance company is already added.');
			return redirect()->back();
		}
		$status = $this->BaseModel->where('id', $id)->update(array(
			'company_name'=> $company_name,
			'price'=> $insurance_amount,
			'description'=>$description
			));		

		if($status)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path.'/manage');
		}

		Session::flash('error', 'Error while updating '.$this->module_title.'.');
		return redirect()->back();

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');


		$obj_companies = $this->BaseModel;
		if(isset($arr_search_column['q_companyname']) && $arr_search_column['q_companyname']!="")
		{
			$obj_companies = $obj_companies->where('company_name', 'LIKE', "%".$arr_search_column['q_companyname']."%");	
		}

		if(isset($arr_search_column['q_insuranceamount']) && $arr_search_column['q_insuranceamount']!="")
		{
			$obj_companies = $obj_companies->where('price', 'LIKE', "%".$arr_search_column['q_insuranceamount']."%");	
		}

		if(isset($arr_search_column['q_companydate']) && $arr_search_column['q_companydate']!="")
		{
			$obj_companies = $obj_companies->where('created_at', 'LIKE', "%".$arr_search_column['q_companydate']."%");	
		}
		$obj_companies = $obj_companies->select(['id', 'company_name', 'price', 'status', 'created_at']);

		if($obj_companies)
		{
			$json_result  = DataTables::of($obj_companies)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{

				$built_view_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);

				$built_delete_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{

					if($data->status != null && $data->status == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Block" href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" 
						onclick="return confirm_action(this,event,\'Do you really want to activate this record ?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this record ?\')" >Active</a>';
					}

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_delete_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='Edit' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$action_button = $built_view_button.'	'.$built_delete_button;

					$id           = isset($data->id)? base64_encode($data->id) :'';
					$company_name = isset($data->company_name)? $data->company_name :'';
					$price        = isset($data->price)? $data->price :'';

					$status     = isset($data->status)? $data->status :'';
					$created_at = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->id          = $id;				
					$build_result->data[$key]->company_name          = $company_name;				
					$build_result->data[$key]->price          = $price;				

					$build_result->data[$key]->status              = $status;
					$build_result->data[$key]->created_at          = $created_at;
					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}
}
