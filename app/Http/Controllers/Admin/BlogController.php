<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategoriesModel;
use App\Models\BlogModel;
use App\Common\Traits\MultiActionTrait;
use Validator;
use DataTables;
use Session;

class BlogController extends Controller
{
	use MultiActionTrait;	
	public function __construct(BlogCategoriesModel $blog_category_model, BlogModel $blog_model)
	{
		$this->arr_data             = [];
		$this->BaseModel            = $blog_model;
		$this->BlogCategoriesModel  = $blog_category_model;
		$this->admin_panel_slug     = config('app.project.admin_panel_slug');
		$this->admin_url_path       = url(config('app.project.admin_panel_slug'));
		$this->module_url_path      = $this->admin_url_path."/blogs";
		$this->module_title         = "Blogs";
		$this->module_view_folder   = "admin.blogs";
		$this->module_icon          = "fa fa-rss";
		$this->blog_image_base_path = base_path().config('app.project.img_path.blog_image');
		$this->blog_image_path = url('/').config('app.project.img_path.blog_image');
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
		$arr_categories         = [];
		$obj_categories         = $this->BlogCategoriesModel->where('status','1')->get(['id','category_name']);
		$this->arr_data['data'] = $obj_categories;

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
		$this->arr_data['parent_module_url'] = url($this->admin_panel_slug);

		return view($this->module_view_folder.'.create',$this->arr_data);
	}

	public function edit($enc_id)
	{
		$arr_blog = [];		
		$id       = base64_decode($enc_id);

		$obj_blog = $this->BaseModel->where('id',$id)
		->select(['blog_category_id', 'title', 'description', 'blog_image'])->first();
		
		if($obj_blog)
		{
			$arr_blog = $obj_blog->toArray();
		}

		$arr_categories = [];
		$obj_categories = $this->BlogCategoriesModel->where('status','1')->get(['id','category_name']);

		$this->arr_data['data']                = $obj_categories;
		$this->arr_data['blog']                = $arr_blog;
		$this->arr_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_data['parent_module_icon']  = "icon-home2";
		$this->arr_data['parent_module_title'] = "Dashboard";
		$this->arr_data['module_title']        = str_plural($this->module_title);
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url']          = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']       = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['blog_image_path']     = $this->blog_image_path;
		$this->arr_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_data['sub_module_icon']     = 'fa fa-plus';
		$this->arr_data['parent_module_url']   = url($this->admin_panel_slug);
		$this->arr_data['id']                  = $enc_id;

		return view($this->module_view_folder.'.edit',$this->arr_data);
	}

	public function update(Request $request, $enc_id)
	{
		$id       = base64_decode($enc_id);
		$arr_rules      = array();
		$status         = false;

		$arr_rules['category_id'] = "required";
		$arr_rules['title']       = "required";
		$arr_rules['description'] = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['blog_category_id'] = base64_decode($request->input('category_id', null));
		$arr_data['title']            = $request->input('title', null);
		$arr_data['description']      = $request->input('description', null);
		$arr_data['slug']             = str_slug($request->input('title', null));

		$dose_exist  = $this->BaseModel->where('id', '!=', $id)->where('title', '=', $arr_data['title'])->count();

		if($dose_exist)
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already added.');
			return redirect()->back();
		}

		if($request->hasFile('blog_image'))
		{
			$obj_blog       = $this->BaseModel->where('id',$id)->select(['blog_image'])->first();

			@unlink($this->blog_image_base_path.$obj_blog->blog_image);
			
			$file           = $request->file('blog_image');
			$file_extension = strtolower($request->file('blog_image')->getClientOriginalExtension());
			
			if(in_array($file_extension,['png','jpg','jpeg','gif']))
			{
				$file_name              = time().uniqid().'.'.$file_extension;
				$isUpload               = $file->move($this->blog_image_base_path, $file_name);
				$arr_data['blog_image'] = $file_name;
				
			}
		}
		$status = $this->BaseModel->where('id', $id)->update($arr_data);

		if($status)
		{
			return redirect($this->module_url_path.'/manage')->with('success',str_singular($this->module_title).' updated successfully.');
		}

		return redirect()->back()->with('error','Error while updating '.str_singular($this->module_title));
	}



	public function store(Request $request)
	{
		$arr_rules      = array();
		$status         = false;

		$arr_rules['category_id'] = "required";
		$arr_rules['title']       = "required";
		$arr_rules['description'] = "required";
		$arr_rules['blog_image']  = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['blog_category_id'] = base64_decode($request->input('category_id', null));
		$arr_data['title']            = $request->input('title', null);
		$arr_data['description']      = $request->input('description', null);
		$arr_data['slug']             = str_slug($request->input('title', null));

		$dose_exist  = $this->BaseModel->where('title', '=', $arr_data['title'])->count();

		if($dose_exist)
		{
			Session::flash('error', 'This '.str_singular($this->module_title).' is already added.');
			return redirect()->back();
		}

		if($request->hasFile('blog_image'))
		{
			$file = $request->file('blog_image');
			$file_extension = strtolower($request->file('blog_image')->getClientOriginalExtension());
			
			if(in_array($file_extension,['png','jpg','jpeg','gif']))
			{
				$file_name              = time().uniqid().'.'.$file_extension;
				$isUpload               = $file->move($this->blog_image_base_path, $file_name);
				$arr_data['blog_image'] = $file_name;
				
				if($isUpload)
				{
					$status = $this->BaseModel->create($arr_data);

					if($status)
					{
						return redirect($this->module_url_path.'/manage')->with('success',str_singular($this->module_title).' created successfully.');
					}
					return redirect()->back()->with('error','Error while creating '.str_singular($this->module_title));

				}
				return redirect()->back()->with('error','Error while creating '.str_singular($this->module_title));
			}
			else
			{
				return redirect()->back()->with('error','Invalid File type, please select valid image file');  				
			}

			return redirect()->back()->with('error','Error while creating '.str_singular($this->module_title));
		}

		return redirect()->back()->with('error','Error while creating '.str_singular($this->module_title));

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');


		$obj_blog_categories = $this->BaseModel;
		if(isset($arr_search_column['q_blogname']) && $arr_search_column['q_blogname']!="")
		{
			$obj_blog_categories = $obj_blog_categories->where('title', 'LIKE', "%".$arr_search_column['q_blogname']."%");	
		}

		if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
		{
			$search_cat = $arr_search_column['q_category'];
			$obj_blog_categories = $obj_blog_categories->whereHas('blog_category',function($query) use($search_cat){
				$query->where('category_name', 'LIKE', "%".$search_cat."%");	
			});	
		}

		$obj_blog_categories = $obj_blog_categories->select(['id','blog_category_id', 'title', 'description', 'status', 'created_at'])
												   ->with(['blog_category' => function($query){
												   		$query->select('id','category_name');
												   }]);

		if($obj_blog_categories)
		{
			$json_result  = DataTables::of($obj_blog_categories)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				
				$built_view_href         = $this->module_url_path.'/edit/'.base64_encode($data->id);
				$built_bank_details_href = $this->module_url_path.'/delete/'.base64_encode($data->id);

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

					$id            = isset($data->id)? base64_encode($data->id) :'';
					$blog_name     = isset($data->blog_name)? $data->blog_name :'';
					$description   = isset($data->description)? str_limit($data->description, 50) :'';
					$status        = isset($data->status)? $data->status :'';
					$created_at    = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->blog_name           = $blog_name;				
					$build_result->data[$key]->category_name       = isset($data->blog_category->category_name)? $data->blog_category->category_name : '';				
					$build_result->data[$key]->description         = $description;				
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
