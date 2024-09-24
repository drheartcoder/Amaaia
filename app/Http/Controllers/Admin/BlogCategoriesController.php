<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategoriesModel;
use App\Common\Traits\MultiActionTrait;
use Validator;
use DataTables;
use Session;

class BlogCategoriesController extends Controller
{
  
    use MultiActionTrait;	
	public function __construct(BlogCategoriesModel $blog_categories_model)
	{
		$this->arr_data            = [];
		$this->BlogCategoriesModel = $blog_categories_model;
		$this->BaseModel           = $blog_categories_model;
		$this->admin_panel_slug    = config('app.project.admin_panel_slug');
		$this->admin_url_path      = url(config('app.project.admin_panel_slug'));
		$this->module_url_path     = $this->admin_url_path."/blog_categories";
		$this->module_title        = "Blog Categories";
		$this->module_view_folder  = "admin.blog_categories";
		$this->module_icon         = "fa fa-cubes";
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
		$this->arr_data['page_title']             = "Add ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']     = "icon-home2";
		$this->arr_data['parent_module_title']    = "Dashboard";
		$this->arr_data['module_title']           = str_plural($this->module_title);
		$this->arr_data['module_icon']            = $this->module_icon;
		$this->arr_data['module_icon']            = $this->module_icon;
		$this->arr_data['module_url']             = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']          = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']          = $this->module_url_path;
		$this->arr_data['admin_panel_slug']       = $this->admin_panel_slug;
		$this->arr_data['sub_module_title']       = 'Add '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']        = 'fa fa-plus';
		$this->arr_view_data['parent_module_url'] = $this->admin_panel_slug;

		return view($this->module_view_folder.'.create',$this->arr_data);
	}

	public function store(Request $request)
	{
		
		$arr_rules      = array();
		$status         = false;

		$arr_rules['category_name']  = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$category_name = $request->input('category_name', null);
		$slug       = str_slug($category_name);

		$dose_exist = $this->BaseModel->where('category_name', '=', $category_name)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already added.');
			return redirect()->back();
		}
		
		$status = $this->BaseModel->create(array(
			'category_name'=> $category_name,
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
		$arr_category = [];

		$obj_category = $this->BaseModel->where('id',$id)->select('category_name')->first();
		
		if($obj_category)
		{
			$arr_category = $obj_category->toArray();	
		}

		$this->arr_data['arr_category']           = $arr_category;
		$this->arr_data['id']                     = $enc_id;
		$this->arr_data['page_title']             = "Edit ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']     = "icon-home2";
		$this->arr_data['parent_module_title']    = "Dashboard";
		$this->arr_data['module_title']           = str_plural($this->module_title);
		$this->arr_data['module_icon']            = $this->module_icon;
		$this->arr_data['module_icon']            = $this->module_icon;
		$this->arr_data['module_url']             = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']          = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']          = $this->module_url_path;
		$this->arr_data['admin_panel_slug']       = $this->admin_panel_slug;
		$this->arr_data['sub_module_title']       = 'Edit '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']        = 'fa fa-pencil-square-o';
		$this->arr_view_data['parent_module_url'] = $this->admin_panel_slug;

		return view($this->module_view_folder.'.edit',$this->arr_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['category_name']  = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$category_name = $request->input('category_name', null);
		$id         = base64_decode($enc_id);
		$obj_category = $this->BaseModel->where('id',$id)->select('category_name')->first();

		if($obj_category->category_name == $category_name)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path.'/manage');

		}

		$dose_exist = $this->BaseModel->where('category_name', '=', $category_name)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already added.');
			return redirect()->back();
		}
		$status = $this->BaseModel->where('id', $id)->update(array(
			'category_name'=> $category_name
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


		$obj_blog_categories = $this->BaseModel;
		if(isset($arr_search_column['q_blogcategoryname']) && $arr_search_column['q_blogcategoryname']!="")
		{
			$obj_blog_categories = $obj_blog_categories->where('category_name', 'LIKE', "%".$arr_search_column['q_blogcategoryname']."%");	
		}

		if(isset($arr_search_column['q_blogcategorydate']) && $arr_search_column['q_blogcategorydate']!="")
		{
			$obj_blog_categories = $obj_blog_categories->where('created_at', 'LIKE', "%".$arr_search_column['q_blogcategorydate']."%");	
		}
		$obj_blog_categories = $obj_blog_categories->select(['id', 'category_name', 'status', 'created_at']);

		if($obj_blog_categories)
		{
			$json_result  = DataTables::of($obj_blog_categories)->make(true);
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
					$category_name = isset($data->category_name)? $data->category_name :'';
					$status     = isset($data->status)? $data->status :'';
					$created_at = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->id          = $id;				
					$build_result->data[$key]->category_name          = $category_name;				
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
