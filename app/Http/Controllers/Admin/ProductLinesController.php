<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductLinesModel;

use App\Common\Traits\MultiActionTrait;

use Validator;
use Session;
use DataTables;

class ProductLinesController extends Controller
{

	use MultiActionTrait;	
	public function __construct(ProductLinesModel $product_lines_model)
	{
		$this->arr_view_data           = [];
		$this->ProductLinesModel       = $product_lines_model;
		$this->admin_panel_slug        = config('app.project.admin_panel_slug');
		$this->admin_url_path          = url(config('app.project.admin_panel_slug'));
		$this->module_url_path         = $this->admin_url_path."/product_line";
		$this->module_title            = "Product Line";
		$this->module_view_folder      = "admin.product_lines";
		$this->module_icon             = "icon-cube4";
		$this->BaseModel               = $product_lines_model;

		$this->product_line_image_base_path	= base_path().config('app.project.img_path.product_line_image');
		$this->product_line_image_public_path	= url('/').config('app.project.img_path.product_line_image');
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
		$arr_categories = [];

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

		$this->arr_view_data['arr_categories']     = $arr_categories;
		$this->arr_view_data['arr_sub_categories'] = array();

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
		$arr_rules = $arr_product_line = array();
		$status    = false;
		$file_name = '';

		$arr_rules['product_type']      = "required";
		$arr_rules['category_name']     = "required";
		$arr_rules['subcategory_name']  = "required";
		$arr_rules['product_line_name'] = "required";

		

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}


		$product_type      = $request->input('product_type', null);
		$category_name     = $request->input('category_name', null);
		$subcategory_name  = $request->input('subcategory_name', null);
		$product_line_name = $request->input('product_line_name', null);

		$slug  = str_slug($product_line_name);
		$model = "ProductLinesModel";
		$slug  = get_slug($model,$slug);

		$arr_product_line = array(
			'product_type'      => $product_type,
			'category_id'       => $category_name,
			'sub_category_id'   => $subcategory_name,
			'product_line_name' => $product_line_name
			);

		$dose_exist = $this->BaseModel->where($arr_product_line)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back();
		}
		
		$arr_product_line['slug'] = $slug;


		if($request->hasFile('image'))
		{
			$file_name = $request->input('image');
			$file_extension = strtolower($request->file('image')->getClientOriginalExtension());
			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
				$isUpload = $request->file('image')->move($this->product_line_image_base_path , $file_name);
			}
			else
			{
				Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
				return redirect()->back();
			}
		}	
		$arr_product_line['image'] = $file_name;
		$status = $this->BaseModel->create($arr_product_line);	
		if($status)
		{
			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title.'.');
		return redirect()->back();
	}

	public function edit($enc_id)
	{
		$arr_product_line  = [];
		$arr_categories    = [];
		$arr_subcategories = [];

		$id = base64_decode($enc_id);

		$obj_product_line = $this->BaseModel->where('id',$id)->select('product_type', 'category_id', 'sub_category_id', 'product_line_name','image')->first();

		if($obj_product_line)
		{
			$arr_product_line  = $obj_product_line->toArray();	
			$arr_categories    = get_categories($arr_product_line['product_type']);
			$arr_subcategories = get_sub_categories($arr_product_line['category_id']);
		}


		$this->arr_view_data['arr_product_line']    = $arr_product_line;
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

		$this->arr_view_data['module_url_path']              = $this->module_url_path;
		$this->arr_view_data['arr_categories']               = $arr_categories;
		$this->arr_view_data['arr_subcategories']            = $arr_subcategories;
		$this->arr_view_data['product_line_image_base_path'] = $this->product_line_image_base_path;
		$this->arr_view_data['product_line_image_public_path'] = $this->product_line_image_public_path;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		// dd($request->all());
		$id         = base64_decode($enc_id);
		$arr_rules      = $arr_product_line = array();
		$status         = false;
		$old_image    = $request->input('oldimage');

		$arr_rules['product_type']      = "required";
		$arr_rules['category_name']     = "required";
		$arr_rules['subcategory_name']  = "required";
		$arr_rules['product_line_name'] = "required";

		

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}


		$product_type      = $request->input('product_type', null);
		$category_name     = $request->input('category_name', null);
		$subcategory_name  = $request->input('subcategory_name', null);
		$product_line_name = $request->input('product_line_name', null);

		$slug  = str_slug($product_line_name);
		$model = "ProductLinesModel";
		$slug  = get_slug($model,$slug);

		$arr_product_line = array(
			'product_type'      => $product_type,
			'category_id'       => $category_name,
			'sub_category_id'   => $subcategory_name,
			'product_line_name' => $product_line_name
			);


		$dose_exist = $this->BaseModel->where($arr_product_line)->where('id', '!=', $id)->count();

		$arr_product_line['slug'] = $slug;


		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back();
		}

if($request->hasFile('image'))
		{
			$file_name = $request->input('image');
			$file_extension = strtolower($request->file('image')->getClientOriginalExtension());
			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
				$isUpload = $request->file('image')->move($this->product_line_image_base_path , $file_name);
				if($isUpload)
				{
					if ($old_image!="" && $old_image!=null) 
					{
						if (file_exists($this->product_line_image_base_path.$old_image))
						{
							@unlink($this->product_line_image_base_path.$old_image);
						}
					}
				}
			}
			else
			{
				Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
				return redirect()->back();
			}
		}
		else
		{
			$file_name = $old_image;
		}


$arr_product_line['image'] = $file_name;

		$status = $this->BaseModel->where('id', $id)->update($arr_product_line);		

		if($status)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating '.$this->module_title.'.');
		return redirect()->back();

	}

	public function load_data(Request $request)

	{
		$arr_search_column      = $request->input('column_filter');

		$obj_product_line = $this->BaseModel;
		
		$obj_product_line = $obj_product_line->with(['category']);

		if(isset($arr_search_column['q_product_line_name']) && $arr_search_column['q_product_line_name']!="")
		{
			$obj_product_line = $obj_product_line->where('product_line_name', 'LIKE', "%".$arr_search_column['q_product_line_name']."%");
		}
		$obj_product_line = $obj_product_line->with(['sub_category']);


		$obj_product_line = $obj_product_line->get();

		if($obj_product_line)
		{
			$json_result  = DataTables::of($obj_product_line)->make(true);
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

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->product_line_name       = isset($data->product_line_name)? $data->product_line_name :'';				
					$build_result->data[$key]->subcategory_name       = isset($data->sub_category->subcategory_name)? $data->sub_category->subcategory_name :'';			
					$build_result->data[$key]->category_name       = isset($data->category->category_name)? $data->category->category_name :'';			
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}

			return response()->json($build_result);
		}
	}

// ---------------------------Ajax Calls---------------------------

	public function load_category(Request $request)
	{
		$data = '<option value="">Select Category</option>';
		$product_type = $request->input('product_type',null);
		if($product_type!=null)
		{
			$arr_categories = get_categories($product_type);

			foreach ($arr_categories as $key => $category) 
			{
				$data .="<option value='".$category['id']."'>".$category['category_name']."</option>";
			}
		}
		return response()->json($data);
	}

	public function load_subcategory(Request $request)
	{
		$data         = '<option value="">Select Subcategory</option>';
		$category_id = $request->input('category_id',null);

		if($category_id!=null)
		{
			$arr_sub_categories = get_sub_categories($category_id);

			foreach ($arr_sub_categories as $key => $sub_category) 
			{
				$data .="<option value='".$sub_category['id']."'>".$sub_category['subcategory_name']."</option>";
			}
		}
		return response()->json($data);
	}
}



