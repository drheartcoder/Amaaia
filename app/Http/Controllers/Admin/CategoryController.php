<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CategoryModel;
use App\Common\Traits\MultiActionTrait;

use Validator;
use Session;
use DataTables;

class CategoryController extends Controller
{
	use MultiActionTrait;
    function __construct(CategoryModel $category_model)
    {  	
    	$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/categories";
		$this->module_title       = "Category";
		$this->module_view_folder = "admin.categories";
		$this->module_icon        = "fa fa-newspaper-o";
		$this->CategoryModel      = $category_model;
		$this->BaseModel          = $category_model;
    }

    public function index(Request $request)
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

    public function create(Request $request)
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

    public function load_data(Request $request)
    {
    	$obj_categories  = "";

		$arr_search_column      = $request->input('column_filter');

		$obj_categories = $this->CategoryModel;

		if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
		{
			$obj_categories = $obj_categories->where('category_name', 'LIKE', "%".$arr_search_column['q_category']."%");	
		}
		
		$obj_categories = $obj_categories->select('id','product_type','category_name','status','created_at');
		
		if($obj_categories)
		{
			$json_result = DataTables::of($obj_categories)->make(true);
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


					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$action_button = $built_view_button;

					if(isset($data->product_type) && $data->product_type == 1)
					{
						$build_result->data[$key]->product_type = 'Classic';
					}
					else
					{
						$build_result->data[$key]->product_type = 'Luxure';
					}


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

    public function store(Request $request)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['category_name']  = "required";
		$arr_rules['product_type']   = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$category     = $request->input('category_name', null);
		
		$product_type = $request->input('product_type', null);
		
		$model = "CategoryModel";
		$slug     = str_slug($category);
		$slug = get_slug($model,$slug);
		
		if($category!=null)
		{
			$category = trim($category);
			
			
			$is_exist = $this->CategoryModel->where([
													'category_name' => $category,
													'product_type' => $product_type
													])->count();

			if($is_exist>0)
			{
				Session::flash('error', 'This '.$this->module_title.' is already exist.');
				return redirect()->back()->withErrors($validator);
			}

			$status = $this->CategoryModel->create([
													'category_name' => $category,
													'slug'          => $slug,
													'product_type'  => $product_type,
													'status'        => '1'
												  ]);
			if($status)
			{
				Session::flash('success', $this->module_title.' added successfully.');
				return redirect($this->module_url_path);
			}

			Session::flash('error', 'Error while adding '.$this->module_title);
			return redirect()->back();
		}
		
		Session::flash('error', 'Error while adding '.$this->module_title);
		return redirect()->back();
	}

	public function edit($id=null)
	{
		$arr_category = [];

		if($id!=null)
		{
			$id           = base64_decode($id);	
			$obj_category = $this->CategoryModel->where('id',$id)->first();
			$arr_category = $obj_category->toArray();
		}

		$this->arr_view_data['page_title']           = "Edit ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']           =  $this->module_url_path;
        $this->arr_view_data['sub_module_title']     =  'Edit '.$this->module_title;
        $this->arr_view_data['sub_module_icon']      =  'fa fa-pencil-square-o';

		$this->arr_view_data['id']                   = base64_encode($id);
		$this->arr_view_data['category']             = $arr_category;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $id=null)
	{
		$arr_category = [];
		$arr_rules      = array();
		$status         = false;

		$arr_rules['category_name']  = "required";
		$arr_rules['product_type']   = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$category = $request->input('category_name', null);

		$product_type = $request->input('product_type', null);
		if($id!=null)
		{
			$id           = base64_decode($id);	
			$obj_category = $this->CategoryModel->where('id',$id)->first();
			$arr_category = $obj_category->toArray();

		}
		
		if($category!=null)
		{
			// $category     = strtolower(trim($category));
			
			$is_exist = $this->CategoryModel->where([
													'category_name' => $category,
													'product_type' => $product_type
													])
													->where('id','<>',$id)
													->count();
			if($is_exist>0)
			{
				Session::flash('error', 'This '.$this->module_title.' is already exist.');
				return redirect()->back()->withErrors($validator);
			}



			$status = $this->CategoryModel->where('id', $id)->update(['category_name'=>$category,'product_type' => $product_type]);
			if($status)
			{
				Session::flash('success', $this->module_title.' updated successfully.');
				return redirect($this->module_url_path);
			}
			
			Session::flash('error', 'Error while updating '.$this->module_title);
			return redirect()->back();
		}
		Session::flash('error', 'Error while updating '.$this->module_title);
		return redirect()->back();
	}

}
