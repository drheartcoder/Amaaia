<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SubCategoryModel;
use App\Models\CategoryModel;

use App\Common\Traits\MultiActionTrait;

Use Validator;
Use Session;

use DataTables;

class SubCategoryController extends Controller
{
	use MultiActionTrait;
   	public function __construct(
   								SubCategoryModel $sub_category_model,
   								CategoryModel    $category_model
   								)
   	{

		$this->arr_view_data                  = [];
		$this->admin_panel_slug               = config('app.project.admin_panel_slug');
		$this->admin_url_path                 = url(config('app.project.admin_panel_slug'));
		$this->module_url_path                = $this->admin_url_path."/sub_categories";
		$this->module_title                   = "Sub Category";
		$this->module_view_folder             = "admin.sub_categories";
		$this->module_icon                    = "fa fa-file-text";
		$this->sub_category_image_base_path   = base_path().config('app.project.img_path.sub_category_image');
		$this->sub_category_image_public_path = url('/').config('app.project.img_path.sub_category_image');

		$this->SubCategoryModel               = $sub_category_model;
		$this->CategoryModel                  = $category_model;
		$this->BaseModel                      = $sub_category_model;
   	}

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
    	$obj_sub_categories  = "";

		$arr_search_column      = $request->input('column_filter');

		$obj_sub_categories = $this->SubCategoryModel;

		if(isset($arr_search_column['q_sub_category']) && $arr_search_column['q_sub_category']!="")
		{
			$obj_sub_categories = $obj_sub_categories->where('subcategory_name', 'LIKE', "%".$arr_search_column['q_sub_category']."%");	
		}
		if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
		{
			$category_search = $arr_search_column['q_category'];
			$obj_sub_categories = $obj_sub_categories->whereHas('get_category' , function($query) use($category_search){
				$query->where('category_name', 'LIKE', "%".$category_search."%");
			});	
		}
		
		$obj_sub_categories = $obj_sub_categories->with('get_category');
		
		if($obj_sub_categories)
		{
			$json_result = DataTables::of($obj_sub_categories)->make(true);
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

					$id                        = isset($data->id)? base64_encode($data->id) :'';
					$subcategory_name          = isset($data->subcategory_name)? $data->subcategory_name :'';
					$category_name             = isset($data->get_category->category_name)? $data->get_category->category_name :'';
					$market_orientation_markup = isset($data->market_orientation_markup)? $data->market_orientation_markup :'';
					$status                    = isset($data->status)? $data->status :'';
					$created_at                = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->subcategory_name    = $subcategory_name;				
					$build_result->data[$key]->category_name       = $category_name;
					$build_result->data[$key]->category_name       = $category_name;
					$build_result->data[$key]->status              = $status;
					$build_result->data[$key]->created_at          = $created_at;
					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	
    }

    public function edit($id=null)
	{
		$arr_sub_category = [];

		if($id!=null)
		{
			$id               = base64_decode($id);
			$obj_sub_category = $this->SubCategoryModel->where('id',$id)->first();
			$arr_sub_category = $obj_sub_category->toArray();
		}


		$this->arr_view_data['page_title']                     = "Edit ".$this->module_title;
		$this->arr_view_data['parent_module_icon']             = "icon-home2";
		$this->arr_view_data['parent_module_title']            = "Dashboard";
		$this->arr_view_data['parent_module_url']              = url('/').'/admin/dashboard';
		$this->arr_view_data['module_icon']                    = $this->module_icon;
		$this->arr_view_data['module_title']                   = "Manage ".$this->module_title;
		$this->arr_view_data['module_url']                     = $this->module_url_path;
		$this->arr_view_data['sub_module_title']               = 'Edit '.$this->module_title;
		$this->arr_view_data['sub_module_icon']                = 'fa fa-pencil-square-o';

		$this->arr_view_data['sub_category_image_base_path']   = $this->sub_category_image_base_path;
		$this->arr_view_data['sub_category_image_public_path'] = $this->sub_category_image_public_path;

		$this->arr_view_data['id']                             = base64_encode($id);
		$this->arr_view_data['arr_sub_category']               = $arr_sub_category;
		$this->arr_view_data['module_url_path']                = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']               = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $id=null)
	{
		$arr_category = [];
		$arr_rules    = array();
		$status       = false;

		$old_image    = "";
		$old_image    = $request->input('oldimage');
		
		if($old_image == '')
		{
			$arr_rules['image'] = "required";
		}

		$arr_rules['category_name']             = "required";
		$arr_rules['sub_category_name']         = "required";
		$arr_rules['product_type']              = "required";
		$arr_rules['market_orientation_markup'] = "required";
		$arr_rules['description']               = "required";


		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if($request->hasFile('image'))
		{
			$file_name = $request->input('image');
			$file_extension = strtolower($request->file('image')->getClientOriginalExtension());
			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
				$isUpload = $request->file('image')->move($this->sub_category_image_base_path , $file_name);
				if($isUpload)
				{
					if ($old_image!="" && $old_image!=null) 
					{
						if (file_exists($this->sub_category_image_base_path.$old_image))
						{
							@unlink($this->sub_category_image_base_path.$old_image);
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

		$category_id               = $request->input('category_name', null);
		$subcategory_name          = $request->input('sub_category_name', null);
		$market_orientation_markup = $request->input('market_orientation_markup', null);
		$description               = $request->input('description', null);
		$slug                      = str_slug($subcategory_name);

		$model = "SubCategoryModel";

		$slug = get_slug($model,$slug);

		$product_type = $request->input('product_type', null);

		$arr_sub_category['product_type']              = $product_type;
		$arr_sub_category['category_id']               = $category_id;
		$arr_sub_category['subcategory_name']          = $subcategory_name;
		$arr_sub_category['market_orientation_markup'] = $market_orientation_markup;
		$arr_sub_category['description']               = $description;
		$arr_sub_category['image']                     = $file_name;
		$arr_sub_category['slug']                      = $slug;

		if($id!=null)
		{
			$id           = base64_decode($id);	
		}

		$is_exist = $this->SubCategoryModel->where([
												'subcategory_name' => $subcategory_name,
												'category_id'      => $category_id,
												'product_type'     => $product_type,
												])
												->where('id','<>',$id)
												->count();
		if($is_exist>0)
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back()->withErrors($validator);
		}



		$status = $this->SubCategoryModel->where('id', $id)->update($arr_sub_category);
		if($status)
		{
			update_final_price();
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path);
		}
		
		Session::flash('error', 'Error while updating '.$this->module_title);
		return redirect()->back();
		
	}


   	public function create()
   	{
		$this->arr_view_data['page_title']                     = "Create ".$this->module_title;
		$this->arr_view_data['parent_module_icon']             = "icon-home2";
		$this->arr_view_data['parent_module_title']            = "Dashboard";
		$this->arr_view_data['parent_module_url']              = url('/').'/admin/dashboard';
		$this->arr_view_data['module_icon']                    = $this->module_icon;
		$this->arr_view_data['module_title']                   = "Manage ".$this->module_title;
		$this->arr_view_data['module_url']                     = $this->module_url_path;
		$this->arr_view_data['sub_module_title']               = 'Add '.$this->module_title;
		$this->arr_view_data['sub_module_icon']                = 'fa fa-plus';

		$this->arr_view_data['sub_category_image_base_path']   = $this->sub_category_image_base_path;
		$this->arr_view_data['sub_category_image_public_path'] = $this->sub_category_image_public_path;

		$this->arr_view_data['module_url_path']                = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']               = $this->admin_panel_slug;

		return view($this->module_view_folder.'.create',$this->arr_view_data);
   	}

   	public function get_category_by_product_type(Request $request)
   	{
   		if(isset($request->product_type_id) && !empty($request->product_type_id))
   		{
			$arr_categories = [];
			$arr_categories = get_category_by_product_type($request->product_type_id);

			return $arr_categories;
   		}
   	}

   	public function store(Request $request)
   	{
		$arr_rules                              = $arr_sub_category = array();
		$status                                 = false;
		$arr_rules['category_name']             = "required";
		$arr_rules['sub_category_name']         = "required";
		$arr_rules['product_type']              = "required";
		$arr_rules['market_orientation_markup'] = "required";
		$arr_rules['description']               = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if($request->hasFile('image'))
		{
			$file_name = $request->input('image');
			$file_extension = strtolower($request->file('image')->getClientOriginalExtension());
			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
				$isUpload = $request->file('image')->move($this->sub_category_image_base_path , $file_name);
			}
			else
			{
				Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
				return redirect()->back();
			}
		}

		$category_id               = $request->input('category_name', null);
		$subcategory_name          = $request->input('sub_category_name', null);
		$market_orientation_markup = $request->input('market_orientation_markup', null);
		$description               = $request->input('description', null);

		$slug     = str_slug($subcategory_name);

		$model = "SubCategoryModel";

		$slug = get_slug($model,$slug);

		$product_type = $request->input('product_type', null);

		$arr_sub_category['product_type']              = $product_type;
		$arr_sub_category['category_id']               = $category_id;
		$arr_sub_category['subcategory_name']          = $subcategory_name;
		$arr_sub_category['market_orientation_markup'] = $market_orientation_markup;
		$arr_sub_category['description']               = $description;
		$arr_sub_category['image']                     = $file_name;
		$arr_sub_category['slug']                      = $slug;
		$arr_sub_category['status']                    = '1';

			
		$is_exist = $this->SubCategoryModel->where([
												'subcategory_name' => $subcategory_name,
												'category_id'      => $category_id,
												'product_type'     => $product_type
												])->count();

		if($is_exist>0)
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$status = $this->SubCategoryModel->create($arr_sub_category);
		if($status)
		{
			update_final_price();
			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title);
		return redirect()->back();
		
	
   	}

}
