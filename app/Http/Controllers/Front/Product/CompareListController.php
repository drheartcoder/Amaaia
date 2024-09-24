<?php

namespace App\Http\Controllers\Front\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductsModel;
use Session;

class CompareListController extends Controller
{
	public function __construct(ProductsModel       $products_model)
	{
		
		$this->arr_view_data       = [];
		$this->user_panel_slug     = config('app.project.user_panel_slug');
		$this->user_url_path       = url(config('app.project.user_panel_slug'));
		$this->module_url_path     = $this->user_url_path;
		$this->module_title        = "Compare List";
		
		$this->ProductsModel       = $products_model;
		$this->BaseModel           = $products_model;

		$this->module_view_folder  = "front.user.compare_list";

		$this->front_url_path            = url('/');
		$this->module_url_path           = $this->front_url_path."/compare_list";

		$this->product_image_base_path   	  = base_path().config('app.project.img_path.product_images');
		$this->product_image_public_path 	  = url('/').config('app.project.img_path.product_images');
	}

	/*
    | Author    : Deepak Bari
    | Date      : 19/05/2018
    | Function  : Add product to compare list.
    */

	public function add_product(Request $request)
	{
		$enc_product_id  = $request->input('enc_product_id');
		$product_img     = $request->input('product_img');
		$remove_products = $request->input('remove_products');
		// Remove previous added data from session in case if new sub category product has to be add.

		if($remove_products != false)
		{
			Session::forget('arr_compare');
		}	

		$arr_return = $arr_compare = [];

		$sub_cat_id = '';
		
		if($enc_product_id != false)
		{
			$product_id = base64_decode($enc_product_id);

			$obj_product = ProductsModel::where('id',$product_id)->select('subcategory_id')->first();

			if($obj_product)
			{
				$sub_cat_id = isset($obj_product->subcategory_id) ? $obj_product->subcategory_id : '';
			}

			$arr_product['product_id']  = $product_id;
			$arr_product['sub_cat_id']  = $sub_cat_id;
			$arr_product['product_img'] = base64_decode($product_img);

			if(Session::has('arr_compare'))
			{
				if(sizeof(Session::get('arr_compare')) >= 4)
				{
					$arr_return['status'] = 'error';
					$arr_return['msg']    = 'You can\'t add more than 4 products in compare list.';

					return $arr_return;
				}
				
				$arr_product_ids = array_column(Session::get('arr_compare'), 'product_id');
				$arr_sub_cat_ids = array_column(Session::get('arr_compare'), 'sub_cat_id');

				if(in_array($product_id, $arr_product_ids))
				{
					$arr_return['status'] = 'error';
					$arr_return['msg']    = 'This product is already added in your compare list.';

					return $arr_return;	
				}

				if(!in_array($sub_cat_id, $arr_sub_cat_ids))
				{
					$arr_return['status'] = 'other_type_product_exist';
					$arr_return['msg']    = 'Compare list already has other cateogories or sub categories product(s). Do you want to proceed? It will remove other products.';

					return $arr_return;	
				}
				
				$arr_compare            = Session::get('arr_compare');
				$new_index = sizeof(Session::get('arr_compare')) + 1;
				$arr_compare[$new_index] = $arr_product;

				Session::put('arr_compare',$arr_compare);
			}
			else
			{
				$arr_compare[0] = $arr_product;

				Session::put('arr_compare',$arr_compare);
			}

    		//Session::flush('arr_compare');
			\Session::save();

			$arr_return['status'] = 'success';
			$arr_return['msg']    = 'Product added to compare list successfully.';
		}
		else
		{
			$arr_return['status'] = 'error';
			$arr_return['msg']    = 'Something went to wrong! Please try again later.';
		}

		return $arr_return;

	}

	/*
    | Author    : Deepak Bari
    | Date      : 19/05/2018
    | Function  : View compare list.
    */

	public function view()
	{
		$arr_products = $arr_product_ids = [];

		if(Session::has('arr_compare') && !empty(Session::get('arr_compare')))
		{
			$arr_product_ids = array_column(Session::get('arr_compare'), 'product_id');

			// Get product attributes.
			$arr_products = get_prduct_attributes_data($arr_product_ids);
		}

		$this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
		$this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;
		
		$this->arr_view_data['parent_module_icon']        = "icon-home2";
		$this->arr_view_data['parent_module_title']       = "Home";
		$this->arr_view_data['parent_module_url']         = $this->front_url_path;
		$this->arr_view_data['page_title']                = $this->module_title;
		$this->arr_view_data['module_title']              = $this->module_title;
		
		$this->arr_view_data['module_url_path']           = $this->module_url_path;
		$this->arr_view_data['user_panel_slug']           = $this->user_panel_slug;
		$this->arr_view_data['arr_products']              = $arr_products;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	/*
    | Author    : Deepak Bari
    | Date      : 21/05/2018
    | Function  : Remove specific product from compare list.
    */
	public function remove_product($enc_product_id = false)
	{
		$arr_compare = $arr_return = [];

		if($enc_product_id)
		{
			$product_id = base64_decode($enc_product_id);

			$arr_compare = Session::get('arr_compare');

			$remove_counter = '';

			if(isset($arr_compare) && !empty($arr_compare))
			{
				foreach ($arr_compare as $key => $val)
				{
					if($val['product_id'] == $product_id)
					{
						unset($arr_compare[$key]);
						$remove_counter ++;
					}
				}
			}
			
			if(isset($arr_compare) && sizeof($arr_compare) != 0)
			{
				Session::put('arr_compare',$arr_compare);
			}
			else
			{
				Session::forget('arr_compare');
				Session::flush('arr_compare');
			}
			\Session::save();	

			if($remove_counter > 0)
			{
				Session::flash('success', 'Product removed successfully from compare list.');
			}
			else
			{
				Session::flash('error', 'Something went to wrong! Please try again later.');
			}
		}
		else
		{
			Session::flash('error', 'Something went to wrong! Please try again later.');
		}

		return redirect()->back();
	}


	public function clear_all()
	{
		Session::forget('arr_compare');
		return redirect()->back();
	} // end clear_all
}
