<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\GemStoneModel;

use Validator;
use Session;
use DataTables;

class GemStoneController extends Controller
{
    
	use MultiActionTrait;	
	public function __construct(GemStoneModel $gemstone_model)
	{
		$this->arr_view_data      = [];
		$this->GemStoneModel      = $gemstone_model;
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/gemstone";
		$this->module_title       = "Gemstone";
		$this->module_view_folder = "admin.gemstone";
		$this->module_icon        = "fa fa-diamond";
		$this->BaseModel          = $gemstone_model;
	}

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

	}

	public function create()
	{
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']        = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']     	    = $this->module_url_path;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
		$arr_rules      = $arr_gemstone = array();
		$status         = false;

		$arr_rules['type']    =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$type = $request->input('type', null);

		$slug       = str_slug($type);

		$model = "GemStoneModel";

		$slug = get_slug($model,$slug);

		$arr_gemstone['type']     = $type;
		$arr_gemstone['slug']     = $slug;
		$arr_gemstone['status']   = '1';

		$dose_exist = $this->BaseModel->where('type', '=', $type)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' type is already exist.');
			return redirect()->back()->withInput();
		}
		
		$status = $this->BaseModel->create($arr_gemstone);		

		if($status)
		{
			Session::flash('success', $this->module_title.' type added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title.' type.');
		return redirect()->back();
	}

	public function edit($enc_id)
	{
		$id = base64_decode($enc_id);
		$arr_gemstone = [];

		$obj_gemstone = $this->BaseModel->where('id',$id)->select('type')->first();
		
		if($obj_gemstone)
		{
			$arr_gemstone = $obj_gemstone->toArray();	
		}

		$this->arr_view_data['arr_gemstone']        = $arr_gemstone;
		$this->arr_view_data['id']                  = $enc_id;
		$this->arr_view_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']        = str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']          = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-pencil-square-o';

		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['type']    =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$type                     = $request->input('type', null);
		$arr_gemstone['type']     = $type;
		
		$id         = base64_decode($enc_id);

		$slug       = str_slug($type);

		$model = "GemStoneModel";

		$slug = get_slug($model,$slug);

		$arr_gemstone['slug'] = isset($slug) ? $slug : '';

		$dose_exist = $this->BaseModel->where('type', '=', $type)
									  ->where('id','<>',$id)
									  ->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' type is already exist.');
			return redirect()->back()->withInput();
		}

		$status = $this->BaseModel->where('id', $id)->update($arr_gemstone);		

		if($status)
		{
			Session::flash('success', $this->module_title.' type updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating '.$this->module_title.' type.');
		return redirect()->back();

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');

		$obj_gemstone = $this->BaseModel;
		if(isset($arr_search_column['q_type']) && $arr_search_column['q_type']!="")
		{
			$obj_gemstone = $obj_gemstone->where('type', 'LIKE', "%".$arr_search_column['q_type']."%");	
		}

		$obj_gemstone = $obj_gemstone->select(['id', 'type','color','quality','shape', 'status', 'created_at']);

		if($obj_gemstone)
		{
			$json_result  = DataTables::of($obj_gemstone)->make(true);
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
						onclick="return confirm_action(this,event,\'Do you really want to activate this record ?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this record ?\')" >Active</a>';
					}

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_bank_details_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='Edit' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$action_button = $built_view_button.'	'.$built_delete_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->type     		   = isset($data->type)? $data->type :'';				
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}


}
