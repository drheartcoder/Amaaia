<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FrontPagesModel;

use App\Common\Traits\MultiActionTrait;

use Validator;
use Session;

use DataTables;

class FrontPagesController extends Controller
{
	use MultiActionTrait;
	
	public function __construct(FrontPagesModel $front_pages_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/front_pages";
		$this->module_title       = "Front Pages";
		$this->module_view_folder = "admin.front_pages";
		$this->module_icon        = "fa fa-file-text";
		$this->FrontPagesModel    = $front_pages_model;
		$this->BaseModel          = $front_pages_model;
	}
	
	/*
    | Function  : Display listing.
    | Author    : Deepak Bari
    | Date      : 17 Feb, 2018
    */

	public function index()
	{
		$this->arr_view_data['page_title']           = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;

		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;

		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	 public function load_data(Request $request)
    {
    	$obj_front_pages  = "";

		$arr_search_column      = $request->input('column_filter');

		$obj_front_pages = $this->FrontPagesModel;

		if(isset($arr_search_column['q_page_title']) && $arr_search_column['q_page_title']!="")
		{
			$obj_front_pages = $obj_front_pages->where('page_title', 'LIKE', "%".$arr_search_column['q_page_title']."%");	
		}
		
		$obj_front_pages = $obj_front_pages->select('*');
		
		if($obj_front_pages)
		{
			$json_result = DataTables::of($obj_front_pages)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_view_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);

				$built_delete_href = $this->module_url_path.'/delete/'.base64_encode($data->id);

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

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_delete_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$action_button = $built_view_button.' '.$built_delete_button;

					if(isset($data->product_type) && $data->product_type == 1)
					{
						$build_result->data[$key]->product_type = 'Classic';
					}
					else
					{
						$build_result->data[$key]->product_type = 'Luxure';
					}

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->page_title          = isset($data->page_title)? $data->page_title :'';				
					
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->meta_title          = isset($data->meta_title) ? $data->meta_title : '';
					$build_result->data[$key]->created_at          = isset($data->created_at) ? get_formated_created_date($data->created_at)  : '';
					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;
				}
			}
			return response()->json($build_result);
		}
    }


	/*
    | Function  : Create new front page.
    | Author    : Deepak Bari
    | Date      : 17 Feb, 2018
    */

	public function create()
	{
	
		$this->arr_view_data['page_title']           = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']           = $this->module_url_path;
        $this->arr_view_data['sub_module_title']     =  'Add '.$this->module_title;
        $this->arr_view_data['sub_module_icon']      =  'fa fa-plus';

        $this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;		
		
		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}


	/*
    | Function  : Store data
    | Author    : Deepak Bari
    | Date      : 17 Feb, 2018
    */

	public function store(Request $request)
	{
		$arr_rules      = $arr_front_page = array();
		$status         = false;

		$arr_rules['page_title']      	   = "required";
		$arr_rules['meta_keyword']         = "required";
		$arr_rules['meta_title']           = "required";
		$arr_rules['meta_description']     = "required";
		
		$arr_rules['page_description']     = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_front_page["page_title"] 			= $request->input('page_title', null);
		$arr_front_page["meta_title"] 		    = $request->input('meta_title', null);
		$arr_front_page["meta_keyword"] 		= $request->input('meta_keyword', null);
		$arr_front_page["meta_description"] 	= $request->input('meta_description', null);
		$arr_front_page["page_description"] 	= $request->input('page_description', null);

		$slug     = str_slug($arr_front_page["page_title"]);
		
		$model = "FrontPagesModel";
		$slug = get_slug($model,$slug);

		$title_slug    = strtolower(trim($arr_front_page["page_title"]));
		$slug     = str_slug($title_slug);
		$arr_front_page["slug"]  = $slug;
		$is_exist = $this->FrontPagesModel->where('page_title',$arr_front_page["page_title"])->count();

		if($is_exist>0)
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already exist.');
			return redirect()->back()->withErrors($validator);
		}

		$status = $this->FrontPagesModel->create($arr_front_page);

		if($status)
		{
			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path);
		}
		Session::flash('error', 'Error while adding '.$this->module_title);
		return redirect()->back();
		
		return redirect()->back();
	}

	/*
    | Function  : Edit details
    | Author    : Deepak Bari
    | Date      : 17 Feb, 2018
    */

	public function edit($id=null)
	{
		$arr_front_pages = [];

		if($id!=null)
		{
			$id           = base64_decode($id);	
			$obj_front_pages = $this->FrontPagesModel->where('id',$id)->first();
			$arr_front_pages = $obj_front_pages->toArray();
		}

		$this->arr_view_data['id']           	= base64_encode($id);
		$this->arr_view_data['arr_front_pages']  = $arr_front_pages;

		
		$this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;


		$this->arr_view_data['page_title']           = "Edit ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']           =  $this->module_url_path;
        $this->arr_view_data['sub_module_title']     =  'Edit '.$this->module_title;
        $this->arr_view_data['sub_module_icon']      =  'fa fa-pencil-square-o';
        
        $this->arr_view_data['module_url_path']      = $this->module_url_path;

		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	/*
    | Function  : Update specific record.
    | Author    : Deepak Bari
    | Date      : 17 Feb, 2018
    */

	public function update(Request $request, $id=null)
	{
		$arr_front_pages = $arr_front_page = [];

		$arr_rules      = array();
		$status         = false;

		$arr_rules['page_title']      	   = "required";
		$arr_rules['meta_keyword']         = "required";
		$arr_rules['meta_title']           = "required";
		$arr_rules['meta_description']     = "required";
		
		$arr_rules['page_description']     = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}


		$arr_front_page["page_title"] 			= $request->input('page_title', null);
		$arr_front_page["meta_title"] 		    = $request->input('meta_title', null);
		$arr_front_page["meta_keyword"] 		= $request->input('meta_keyword', null);
		$arr_front_page["meta_description"] 	= $request->input('meta_description', null);
		$arr_front_page["page_description"] 	= $request->input('page_description', null);

		if($id!=null)
		{
			$id           = base64_decode($id);	
		}

		$is_exist = $this->FrontPagesModel->where('page_title',$arr_front_page["page_title"])
										  ->where('id','<>',$id)
										 ->count();

		if($is_exist>0)
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already exist.');
			return redirect()->back()->withErrors($validator);
		}

		

		
			
		$status = $this->FrontPagesModel->where('id', $id)->update($arr_front_page);
		
		if($status)
		{
			Session::flash('success', $this->module_title.' details updated successfully.');
			return redirect($this->module_url_path);
		}
		
		Session::flash('error', 'Error while updating '.$this->module_title);
		return redirect()->back();
	}

}
