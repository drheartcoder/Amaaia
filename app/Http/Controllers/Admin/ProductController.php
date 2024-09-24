<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use App\Models\ProductImagesModel;
use App\Models\ProductOccasionsModel;
use App\Models\ProductCollectionsModel;

use App\Common\Traits\MultiActionTrait;
use App\Common\Services\NotificationService;
use DataTables;
use Session;

class ProductController extends Controller
{
	use MultiActionTrait;

	public function __construct(
		                         ProductsModel             $products_model, 
		                         ProductImagesModel        $product_images_model,
		                         ProductOccasionsModel     $product_occasions_model,
		                         ProductCollectionsModel   $product_collections_model,
		                         NotificationService       $notification_service
		                       )
	{
		$this->arr_data                  = [];
		$this->BaseModel                 = $products_model;
		$this->ProductImagesModel        = $product_images_model;
		$this->ProductOccasionsModel     = $product_occasions_model;
		$this->ProductCollectionsModel   = $product_collections_model;

		$this->NotificationService       = $notification_service;
		$this->admin_panel_slug          = config('app.project.admin_panel_slug');
		$this->admin_url_path            = url(config('app.project.admin_panel_slug'));
		$this->module_url_path           = $this->admin_url_path."/products";
		$this->module_title              = "Products";
		$this->module_view_folder        = "admin.products";
		$this->module_icon               = "fa fa-diamond";

		$this->product_image_base_path   = base_path().config('app.project.img_path.product_images');
		$this->product_image_public_path = url('/').config('app.project.img_path.product_images');
	}

	public function index($user_type = false)
	{
		$this->arr_view_data['user_type']            = isset($user_type)  ? $user_type : false;
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

	public function view($user_type = false, $enc_id = false)
	{
		
		$arr_product = [];

		if($enc_id != false)
		{
			$id = base64_decode($enc_id);

			$obj_product = $this->BaseModel->where('id' , $id)
			->with(['category' => function($query){
				$query->select('id','category_name');
			}])
			->with(['sub_category' => function($query){
				$query->select('id','subcategory_name');
			}])
			->with(['brand' => function($query){
				$query->select('id','brand_name');
			}])
			->with(['product_metals.metal_name' => function($query){
				$query->select('id','metal_name');
			}])
			->with(['product_metals.metal_color' => function($query){
				$query->select('id','metal_color');
			}])
			->with(['product_metals.metal_quality' => function($query){
				$query->select('id','quality_name');
			}])
			->with(['metal_detailing' => function($query){
				$query->select('id','metal_detailing_name');
			}])
			->with(['setting' => function($query){
				$query->select('id','setting');
			}])
			->with(['product_occasions.occasion' => function($query){
				$query->select('id','occasion_name');
			}])
			->with(['shank_type' => function($query){
				$query->select('id','shank_type');
			}])
			->with(['band_setting' => function($query){
				$query->select('id','band_setting');
			}])
			->with(['ring_shoulder' => function($query){
				$query->select('id','ring_shoulder_type');
			}])
			->with(['product_images' => function($query){
				$query->select('product_id','image');
			}])
			->with(['product_collections.collection' => function($query){
				$query->select('id','name');
			}])
			->with(['product_line' => function($query){
				$query->select('id','product_line_name');
			}])
			->with(['look' => function($query){
				$query->select('id','look');
			}])
			->with(['product_gemstones.gemstone_type' => function($query){
				$query->select('id','type');
			}])
			->with(['product_gemstones.gemstone_color' => function($query){
				$query->select('id','gemstone_color');
			}])
			->with(['product_gemstones.gemstone_quality' => function($query){
				$query->select('id','gemstone_quality');
			}])
			->with(['product_gemstones.gemstone_shape' => function($query){
				$query->select('id','shape_name');
			}])
			->with(['product_size' => function($query){
				$query->select('*');
			}])
			->first();

			if($obj_product)
			{
				$arr_product = $obj_product->toArray();
			}

			$this->arr_view_data['arr_product']               = $arr_product;

			$this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
			$this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

			$this->arr_view_data['parent_module_icon']        = "icon-home2";
			$this->arr_view_data['parent_module_title']       = "Dashboard";
			$this->arr_view_data['parent_module_url']         = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['page_title']                = "View ".str_plural($this->module_title);
			$this->arr_view_data['module_title']              = "Manage ".str_plural($this->module_title);
			$this->arr_view_data['module_icon']               = $this->module_icon;
			if(isset($user_type) && $user_type == 'supplier')
			{

				$this->arr_view_data['module_url']     	          = $this->module_url_path.'/supplier';
			}
			else
			{

				$this->arr_view_data['module_url']     	          = $this->module_url_path;
			}
			$this->arr_view_data['module_url_path']           = $this->module_url_path;
			$this->arr_view_data['admin_panel_slug']          = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']          = 'View '.str_singular($this->module_title);
			$this->arr_view_data['sub_module_icon']           = 'fa fa-eye';
			$this->arr_view_data['id']                        = $id;

			return view($this->module_view_folder.'.view',$this->arr_view_data);
			
		}
		else
		{
			Session::flash('error','Something went to wrong! Please try again later.');
			return redirect()->back();
		}	
	}

	public function load_data(Request $request)
	{
		$built_edit_button = $built_delete_button = $supplier_name = $supplier_fname = $supplier_lname = $supplier_search = '';
		$arr_supplier_search = [];
		$arr_search_column      = $request->input('column_filter');

		$obj_products = $this->BaseModel;
		if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
		{
			$obj_products = $obj_products->where('product_name', 'LIKE', "%".$arr_search_column['q_product_name']."%");	
		}

		
		
		if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
		{
			$category_search = $arr_search_column['q_category'];

			$obj_products = $obj_products->whereHas('category', function($query) use($category_search){
				$query->where('category_name', 'LIKE', "%".$category_search."%");
			});	
		}

		if(isset($arr_search_column['q_supplier_name']) && $arr_search_column['q_supplier_name']!="")
		{
			$supplier_search = $arr_search_column['q_supplier_name'];
			$arr_supplier_search = explode(' ', $supplier_search);
			if(isset($arr_supplier_search[1]) && !empty($arr_supplier_search[1]))
			{
				$obj_products = $obj_products->whereHas('supplier_details',function($query) use($arr_supplier_search){
				$query->where('first_name', 'LIKE', "%".$arr_supplier_search[0]."%");
				$query->where('last_name', 'LIKE', "%".$arr_supplier_search[1]."%");
				});		
			}
			else
			{
				$obj_products = $obj_products->whereHas('supplier_details',function($query) use($supplier_search){
				$query->where('first_name', 'LIKE', "%".$supplier_search."%");
				$query->orWhere('last_name', 'LIKE', "%".$supplier_search."%");
				});		
			}
			
		}

		$obj_products = $obj_products->select(['id', 'product_name', 'status', 'created_at','category_id','subcategory_id','product_type', 'admin_approval','added_by_user_type', 'added_by_user_id'])
		->with(['category' => function($query){
			$query->select('id','category_name');
		}])
		->with(['sub_category' => function($query){
			$query->select('id','subcategory_name');
		}])
->with('supplier_details')
		;

		if(isset($arr_search_column['user_type']) && $arr_search_column['user_type'] == 'supplier')
		{
			$obj_products = $obj_products->where('added_by_user_type','<>','1');
		}
		else
		{
			$obj_products = $obj_products->where('added_by_user_type','=','1');
		}

		if($obj_products)
		{
			$json_result  = DataTables::of($obj_products)->make(true);
			$build_result = $json_result->getData();


			foreach ($build_result->data as $key => $data) 
			{
				
				$built_approve_href   = $this->module_url_path.'/supplier/approve/'.base64_encode($data->id);

				$built_delete_btn_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($arr_search_column['user_type']) && $arr_search_column['user_type'] == 'supplier')
				{
					$built_view_btn_href   = $this->module_url_path.'/supplier/view/'.base64_encode($data->id);
				}
				else
				{
					$built_view_btn_href   = $this->module_url_path.'/my_own/view/'.base64_encode($data->id);	
				}


				$built_edit_btn_href   = $this->module_url_path.'/jewellery/edit/'.base64_encode($data->id);

				$built_block_btn_href   = $this->module_url_path.'/supplier/block/'.base64_encode($data->id);

				$built_unblock_btn_href   = $this->module_url_path.'/supplier/unblock/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->status != null && $data->status == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Block" href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" 
						onclick="return confirm_action(this,event,\'Do you really want to Unblock this product ?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to block this product ?\')" >Active</a>';
					}

					if(isset($data->added_by_user_type) && $data->added_by_user_type == '1')
					{
						$built_edit_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_edit_btn_href."' title='Edit' data-original-title='View'><i class='fa fa-pencil-square-o'></i></a>";

						$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_delete_btn_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this product ?\")' ><i class='fa fa-trash' ></i></a>";
					}
					else
					{
						$built_edit_button = '';
						$built_delete_button = '';
					}

					

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_btn_href."' title='View' data-original-title='View'><i class='fa fa-eye'></i></a>";
					$built_approve_button='';
					if($data->admin_approval=='0')
					{
						$built_approve_button = '<a  onclick="reject('."'".base64_encode($data->id)."'".')" class="btn btn-default btn-rounded show-tooltip" href="javascript:void(0)" title="reject" data-original-title="Approve"><i class="fa fa-times"></i></a>';
						$built_approve_button .= '<a  onclick="approve('."'".base64_encode($data->id)."'".')" class="btn btn-default btn-rounded show-tooltip" href="javascript:void(0)" title="Approve" data-original-title="Approve"><i class="fa fa-check"></i></a>';
					}elseif($data->admin_approval=='2'){

						$built_approve_button = '<a  onclick="approve('."'".base64_encode($data->id)."'".')" class="btn btn-default btn-rounded show-tooltip" href="javascript:void(0)" title="Approve" data-original-title="Approve"><i class="fa fa-check"></i></a>';

					}

					if(isset($data->product_type) && $data->product_type == '1')
					{
						$product_type = 'Classic';
					}
					elseif(isset($data->product_type) && $data->product_type == '2')
					{
						$product_type = 'Luxury';
					}

					$action_button = $built_view_button.' '.$built_edit_button.'	'.$built_approve_button.' '.$built_delete_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$supplier_fname = isset($data->supplier_details->first_name)? $data->supplier_details->first_name :'';
					$supplier_lname = isset($data->supplier_details->last_name)? $data->supplier_details->last_name :'';

					$supplier_name = $supplier_fname.' '.$supplier_lname;

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->product_name        = isset($data->product_name)? $data->product_name :'';				
					$build_result->data[$key]->product_type        = isset($product_type)? $product_type :'NA';				
					$build_result->data[$key]->category            = isset($data->category->category_name)? $data->category->category_name :'NA';				
					$build_result->data[$key]->sub_category            = isset($data->sub_category->subcategory_name)? $data->sub_category->subcategory_name :'NA';				
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;
					$build_result->data[$key]->supplier_name       = $supplier_name;


				}
			}
			return response()->json($build_result);
		}
	}

	public function approve($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_approve(base64_decode($enc_id)))
        {
        	$obj_product = $this->BaseModel->where('id', base64_decode($enc_id))->first();
        	
        	$arr_data['receiver_user_type_id'] = isset($obj_product->added_by_user_type)? $obj_product->added_by_user_type:3;

        	$arr_data['receiver_user_id'] = isset($obj_product->added_by_user_id)? $obj_product->added_by_user_id:'0';

        	$arr_data['product_name'] = $obj_product->product_name;

        	$arr_data['url'] = 'product/jewellery/view/'.$enc_id;

        	$this->NotificationService->store_product_verifiaction_approval_notification($arr_data);
            Session::flash('success', $this->module_title. ' Approved Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title. ' Approved');
        }

        return redirect()->back();
    }

    public function unapprove($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_unapprove(base64_decode($enc_id)))
        {
        	$obj_product = $this->BaseModel->where('id', base64_decode($enc_id))->first();
        	
        	$arr_data['receiver_user_type_id'] = isset($obj_product->added_by_user_type)? $obj_product->added_by_user_type:3;

        	$arr_data['receiver_user_id'] = isset($obj_product->added_by_user_id)? $obj_product->added_by_user_id:'0';

        	$arr_data['product_name'] = $obj_product->product_name;

        	$arr_data['url'] = 'product/jewellery/view/'.$enc_id;

        	$this->NotificationService->store_product_verifiaction_rejection_notification($arr_data);
            Session::flash('success', $this->module_title. ' rejected Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title. ' rejecting');
        }

        return redirect()->back();
    }

     public function perform_approve($id)
    {
        if($id!=null)
        {
            $responce = $this->BaseModel->where('id',$id)->update(['admin_approval'=>'1']);
            if($responce)
            {
                return TRUE;
            }  
            return FALSE;          
        }
        return FALSE;
    }

    public function perform_unapprove($id)
    {
        if($id!=null)
        {
            $responce = $this->BaseModel->where('id',$id)->update(['admin_approval'=>'2']);
            if($responce)
            {
                return TRUE;
            }  
            return FALSE;          
        }
        return FALSE;
    }

    /*
	| Name : Deepak Bari
	| Function : Delete any specific product by id
	| Date : 29-05-2018
	*/

    public function delete($enc_id = FALSE)
	{
		if(!$enc_id)
		{
			return redirect()->back();
		}

		if($this->perform_delete(base64_decode($enc_id)))
		{
			Session::flash('success', str_singular($this->module_title). ' Deleted Successfully');
		}
		else
		{
			Session::flash('error', 'Problem Occured While '.str_singular($this->module_title).' Deletion ');
		}

		return redirect()->back();
	}

	/*
	| Name : Deepak Bari
	| Function : Perform delete operation.
	| Date : 29-05-2018
	*/

	public function perform_delete($id)
	{
		$delete= $this->BaseModel->where('id',$id)->delete();

		if($delete)
		{
			$this->remove_product_img(false,base64_encode($id));
			$this->ProductImagesModel->where('product_id',$id)->delete();
			$this->ProductOccasionsModel->where('product_id',$id)->delete();
			$this->ProductCollectionsModel->where('product_id',$id)->delete();

			return TRUE;
		}
		return FALSE;
	}

	/*
	| Name : Deepak Bari
	| Function : Remove the images of product which to be deleted.
	| Date : 29-05-2018
	*/

	public function remove_product_img($enc_image_id = false,$enc_product_id = false)
	{
		$arr_img = [];
		if($enc_product_id == false)
		{
			if($enc_image_id != false)
			{
				$image_id = base64_decode($enc_image_id);

				$obj_img = $this->ProductImagesModel->where('id',$image_id)->first();

				if($obj_img)
				{
					$arr_img = $obj_img->toArray();

					if(isset($arr_img['image']) && !empty($arr_img['image']) && file_exists($this->product_image_base_path.'/'.$arr_img['image']))
					{
						@unlink($this->product_image_base_path.'/'.$arr_img['image']);
					} 
				}

				$res = $this->ProductImagesModel->where('id' , $image_id)->delete();
				if($res)
				{
					$arr_response['status']  = 'success';
					$arr_response['message'] = 'Image delete successfully.';
				}
				else
				{
					$arr_response['status']  = 'error';
					$arr_response['message'] = 'Problem occured while deleting image.';
				}

			}
			else
			{
				$arr_response['status']  = 'error';
				$arr_response['message'] = translation('problem_occured_while_deleting').' '.translation('certificate');
			}

			return response()->json($arr_response);
		}
		else
		{
			$product_id = base64_decode($enc_product_id);

			$obj_img = $this->ProductImagesModel->where('product_id',$product_id)->get();
			if($obj_img)
			{
				$arr_img = $obj_img->toArray();

				foreach ($arr_img as $val)
				{
					if(isset($val['image']) && !empty($val['image']) && file_exists($this->product_image_base_path.'/'.$val['image']))
					{
						@unlink($this->product_image_base_path.'/'.$val['image']);
					} 
				}
			}
			return true;
		}
	}

	/*
	| Name : Deepak Bari
	| Function : Store/update discount and additional markup
	| Date : 29-05-2018
	*/

	public function add_discount(Request $request)
	{
		if(isset($request->product_id) && !empty($request->product_id))
		{
			$product_id = base64_decode($request->product_id);
			$arr_data['discount'] = $request->input('discount', "0");
			$arr_data['additional_markup'] = $request->input('additional_markup', '0');

			if(isset($arr_data['discount']) && $arr_data['discount'] != null)
			{

			}
			else
			{
				$arr_data['discount'] = 0;
			}


			if(isset($arr_data['additional_markup']) && $arr_data['additional_markup'] != null)
			{

			}
			else
			{
				$arr_data['additional_markup'] = 0;
			}

			$status = $this->BaseModel->where('id',$product_id)->update($arr_data);

			update_final_price();

			if($status)
			{
				 return redirect()->back()->with('success','Discount and additional markup updated successfully.');
			}
			else
			{
				 return redirect()->back()->with('error','Something went to wrong.');
			}	
		}
		else
		{
			 return redirect()->back()->with('error','Something went to wrong.');
		}
		
	}
}
