<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use App\Common\Traits\MultiActionTrait;
use Validator;
use DataTables;
use Session;

class SettingController extends Controller
{
	use MultiActionTrait;	
	public function __construct(SettingModel $setting_model)
	{
		$this->arr_data           = [];
		$this->BaseModel          = $setting_model;
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/setting";
		$this->module_title       = "Setting";
		$this->module_view_folder = "admin.setting";
		$this->module_icon        = "fa fa-cog";
	}

	public function index()
	{

		$this->arr_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url_path']     = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']       = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['parent_module_url']   = $this->admin_url_path;

		return view($this->module_view_folder.'.index',$this->arr_data);
	}

	public function create()
	{
		$this->arr_data['page_title']          = "Add ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['module_title']        = str_plural($this->module_title);
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url']     = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']       = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']     = 'fa fa-plus';
		$this->arr_view_data['parent_module_url']    = $this->admin_panel_slug;

		return view($this->module_view_folder.'.create',$this->arr_data);
	}
	public function store(Request $request)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['setting']  = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$setting = $request->input('setting', null);

		$slug       = str_slug($setting);

		$model = "SettingModel";

		$slug = get_slug($model,$slug);

		$dose_exist = $this->BaseModel->where('setting', '=', $setting)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already added.');
			return redirect()->back();
		}
		
		$status = $this->BaseModel->create(array(
			'setting'=> $setting,
			'slug'=>$slug
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
		$arr_brand = [];

		$obj_brand = $this->BaseModel->where('id',$id)->select('setting')->first();
		
		if($obj_brand)
		{
			$arr_brand = $obj_brand->toArray();	
		}

		$this->arr_data['arr_brand']           = $arr_brand;
		$this->arr_data['id']                  = $enc_id;
		$this->arr_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['module_title']        = str_plural($this->module_title);
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url']     = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']       = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']     = 'fa fa-pencil-square-o';
		$this->arr_view_data['parent_module_url']    = $this->admin_panel_slug;

		return view($this->module_view_folder.'.edit',$this->arr_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['setting']  = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$setting   = $request->input('setting', null);
		$slug      = str_slug($request->input('setting', null));
		$id        = base64_decode($enc_id);
		$obj_brand = $this->BaseModel->where('id',$id)->select('setting')->first();

		if($obj_brand->setting == $setting)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path.'/manage');

		}

		$dose_exist = $this->BaseModel->where('setting', '=', $setting)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already added.');
			return redirect()->back();
		}

		$slug       = str_slug($setting);

		$model = "SettingModel";

		$slug = get_slug($model,$slug);
		
		$status = $this->BaseModel->where('id', $id)->update(array(
			'setting'=> $setting,
			'slug'=>$slug
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


		$obj_brands = $this->BaseModel;
		if(isset($arr_search_column['q_setting']) && $arr_search_column['q_setting']!="")
		{
			$obj_brands = $obj_brands->where('setting', 'LIKE', "%".$arr_search_column['q_setting']."%");	
		}

		if(isset($arr_search_column['q_branddate']) && $arr_search_column['q_branddate']!="")
		{
			$obj_brands = $obj_brands->where('created_at', 'LIKE', "%".$arr_search_column['q_branddate']."%");	
		}
		$obj_brands = $obj_brands->select(['id', 'setting', 'status', 'created_at']);

		if($obj_brands)
		{
			$json_result  = DataTables::of($obj_brands)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{

				$built_view_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);

				$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{

					if($data->status != null && $data->status == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Block" href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" 
						onclick="return confirm_action(this,event,\'Do you really want to Unblock this record ?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to block this record ?\')" >Active</a>';
					}

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_bank_details_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='Edit' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$action_button = $built_view_button.'	'.$built_delete_button;

					$id = isset($data->id)? base64_encode($data->id) :'';
					$setting = isset($data->setting)? $data->setting :'';
					$status     = isset($data->status)? $data->status :'';
					$created_at = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->id          = $id;				
					$build_result->data[$key]->setting          = $setting;				
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
