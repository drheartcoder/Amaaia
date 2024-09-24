<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;
use App\Common\Services\NotificationService;

use App\Models\ShoppingCartModel;
use App\Models\CartProductModel;
use App\Models\ProductsModel;

use DataTables;
use Session;
use DB;

class ShoppingCartController extends Controller
{
	use MultiActionTrait;

	public function __construct(
									ShoppingCartModel   $shoppingcart_model,
									CartProductModel    $cartproduct_model,
									ProductsModel       $products_model,
									NotificationService $notification_service
								)
	{
		$this->arr_data                       = [];
		$this->admin_panel_slug               = config('app.project.admin_panel_slug');
		$this->admin_url_path                 = url(config('app.project.admin_panel_slug'));
		$this->module_url_path                = $this->admin_url_path."/shopping-cart";
		$this->module_title                   = "Shopping Cart";
		$this->module_view_folder             = "admin.shopping_cart";
		$this->module_icon                    = "fa fa-shopping-cart";

		$this->product_image_base_path        = base_path().config('app.project.img_path.product_images');
		$this->product_image_public_path      = url('/').config('app.project.img_path.product_images');

		$this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');

		$this->BaseModel                      = $cartproduct_model;
		$this->ShoppingCartModel              = $shoppingcart_model;
		$this->NotificationService            = $notification_service;
	}

	public function abandoned()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage Abandoned ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage Abandoned ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path.'/abandoned';
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');

		$obj_cart = $this->BaseModel;
		
		// search user_name
		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$username_search = $arr_search_column['q_user_name'];
			$obj_cart = $obj_cart->whereHas('cart.user_details', function($query) use($username_search){
				$query->where('first_name', 'LIKE', "%".$username_search."%");
				$query->orWhere('last_name', 'LIKE', "%".$username_search."%");
				$query->orwhere(DB::raw('CONCAT_WS(" ", first_name, last_name)'), 'LIKE', "%".$username_search."%");
			});		
		}

		// search email
		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$email_search = $arr_search_column['q_email'];
			$obj_cart = $obj_cart->whereHas('cart.user_details', function($query) use($email_search){
				$query->where('email', 'LIKE', "%".$email_search."%");
			});		
		}

		$obj_cart = $obj_cart->select(['id', 'cart_id', 'product_id', 'product_quantity','name_on_product','created_at', \DB::raw('sum(product_quantity) as quantity')])
		->with(['cart.user_details' => function($query)
		{
			$query->select('id','first_name','last_name', 'email');
		}])
		->groupBy('cart_id');

		if($obj_cart)
		{
			$json_result  = DataTables::of($obj_cart)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_view_btn_href   = $this->module_url_path.'/abandoned/view/'.base64_encode($data->cart_id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_btn_href."' title='View' data-original-title='View'><i class='fa fa-eye'></i></a>";

					$action_button = $built_view_button;
					
					$id         = isset($data->id)? base64_encode($data->id) :'';
					$first_name = isset($data->cart->user_details->first_name) ? $data->cart->user_details->first_name : '';
					$last_name  = isset($data->cart->user_details->last_name) ? $data->cart->user_details->last_name : '';

					$build_result->data[$key]->id                  = $id;
					$build_result->data[$key]->user_name           = $first_name.' '.$last_name;
					$build_result->data[$key]->email               = isset($data->cart->user_details->email) ? $data->cart->user_details->email : '';
					$build_result->data[$key]->quantity            = isset($data->quantity) ? $data->quantity : '';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';
					$build_result->data[$key]->built_action_button = $action_button;
				}
			}
			return response()->json($build_result);
		}
	}


	public function view($enc_id = false)
	{
		$arr_cart = [];

		if($enc_id != false)
		{
			$id = base64_decode($enc_id);

			$obj_cart = $this->BaseModel->where('cart_id' , $id)
			->with(['cart.user_details' => function($query)
			{
				$query->select('id','first_name','last_name','gender','address', 'country_phone_code_id','mobile_number','email','profile_image');
			}])
			->first();

			if($obj_cart)
			{
				$arr_cart = $obj_cart->toArray();
			}

			$this->arr_view_data['arr_cart']                       = $arr_cart;

			$this->arr_view_data['user_profile_image_base_path']   = $this->user_profile_image_base_path;
			$this->arr_view_data['user_profile_image_public_path'] = $this->user_profile_image_public_path;

			$this->arr_view_data['parent_module_icon']             = "icon-home2";
			$this->arr_view_data['parent_module_title']            = "Dashboard";
			$this->arr_view_data['parent_module_url']              = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['page_title']                     = "View Abandoned ".str_plural($this->module_title);
			$this->arr_view_data['module_title']                   = "Manage Abandoned ".str_plural($this->module_title);
			$this->arr_view_data['module_icon']                    = $this->module_icon;
			$this->arr_view_data['module_view_path']               = $this->module_url_path.'/abandoned';
			$this->arr_view_data['module_url_path']                = $this->module_url_path;
			$this->arr_view_data['admin_panel_slug']               = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']               = 'View Abandoned '.str_singular($this->module_title);
			$this->arr_view_data['sub_module_icon']                = 'fa fa-eye';
			$this->arr_view_data['id']                             = $id;
			$this->arr_view_data['enc_id']                         = $enc_id;

			return view($this->module_view_folder.'.view',$this->arr_view_data);
			
		}
		else
		{
			Session::flash('error','Something went to wrong! Please try again later.');
			return redirect()->back();
		}	
	}


	/*
    | Function  : Get all the products data
    | Author    : Deepak Arvind Salunke
    | Date      : 22/05/2018
    | Output    : Show listing of all the products data
    */

	public function load_details(Request $request, $id = false)
	{
		$arr_search_column = $request->input('column_filter');

		$obj_cart = $this->BaseModel->where('cart_id', $id)
									->with(['product_details.category' => function($query)
									{
										$query->select('id','category_name');
									}])
									->with(['product_details.sub_category' => function($query){
										$query->select('id','subcategory_name');
									}]);
		
		// serach product
		if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
		{
			$product_search = $arr_search_column['q_product_name'];
			$obj_cart = $obj_cart->whereHas('product_details', function($query) use($product_search){
				$query->where('product_name', 'LIKE', "%".$product_search."%");
			});		
		}
		
		// serach category
		if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
		{
			$category_search = $arr_search_column['q_category'];
			$obj_cart = $obj_cart->whereHas('product_details.category', function($query) use($category_search){
				$query->where('category_name', 'LIKE', "%".$category_search."%");
			});	
		}

		// serach subcategory
		if(isset($arr_search_column['q_subcategory']) && $arr_search_column['q_subcategory']!="")
		{
			$subcategory_search = $arr_search_column['q_subcategory'];
			$obj_cart = $obj_cart->whereHas('product_details.sub_category', function($query) use($subcategory_search){
				$query->where('subcategory_name', 'LIKE', "%".$subcategory_search."%");
			});	
		}

		//dd($obj_cart->get()->toArray());

		if($obj_cart)
		{
			$json_result  = DataTables::of($obj_cart)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$id         = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id               = $id;
					$build_result->data[$key]->product_name     = isset($data->product_details->product_name) ? $data->product_details->product_name :'';
					$build_result->data[$key]->category_name    = isset($data->product_details->category->category_name) ? $data->product_details->category->category_name :'';
					$build_result->data[$key]->subcategory_name = isset($data->product_details->sub_category->subcategory_name) ? $data->product_details->sub_category->subcategory_name :'';
					$build_result->data[$key]->quantity         = isset($data->product_quantity) ? $data->product_quantity :'';
					$build_result->data[$key]->created_at       = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';
				}
			}
			return response()->json($build_result);
		}
	} // end load_details

}
