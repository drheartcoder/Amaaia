<?php

use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CountryModel;
use App\Models\NotificationsModel;
use App\Models\ProductLinesModel;
use App\Models\ProductsModel;
use App\Models\WishListModel;
use App\Models\ShoppingCartModel;
use App\Models\CartProductModel;
use App\Models\CartGiftCardModel;
use App\Models\SupplierModel;
use App\Models\SiteSettingModel;
use App\Models\UserGiftCardModel;
use App\Models\OrdersModel;
use App\Models\OrdersProductModel;
use App\Models\ReplacementProductRequestModel;



	/*
    | Author    : Deepak Bari
    | Function  : Get the slug by title/name and module name.
    */

    function get_slug($model,$slug)
    {
    	$arr_data = [];

    	$model_name	 = '\\App\\Models\\'.$model;
    	$model = new $model_name;

    	$obj_data = $model->select('slug')->where('slug','LIKE',$slug.'%')
    	->get();

    	if($obj_data)
    	{
    		$arr_data = $obj_data->toArray();
    	}

    	if(isset($arr_data) && !empty($arr_data))
    	{
    		$slugs = array_column($arr_data, 'slug');
    	}

    	if(isset($slugs) && isset($slug) && in_array($slug, $slugs))
    	{
    		$max = 0;

    		while(in_array( ($slug . '-' . ++$max ), $slugs) );

    		$slug .= '-' . $max;
    	}

    	return  $slug;
    }

/*
| Author    : Deepak Bari
| Function  : Get sub-categories by category id.
*/

function get_sub_categories($category_id=null)
{
	$arr_sub_categories = [];
	$obj_sub_categories = SubCategoryModel::select('id','subcategory_name','slug')
	->orderBy('subcategory_name','ASC')
	->where('status','1');

	if($category_id!=null)
	{
		$obj_sub_categories = $obj_sub_categories->where('category_id', $category_id);
	}

	$obj_sub_categories = $obj_sub_categories->get();

	if($obj_sub_categories)
	{
		$arr_sub_categories = $obj_sub_categories->toArray();
		return $arr_sub_categories;
	}	
}


function get_categories($product_type=null)
{
	$arr_categories = [];
	$obj_categories = CategoryModel::select('id','category_name')
	->orderBy('category_name','ASC')
	->where('status','1');

	if($product_type)
	{
		$obj_categories = $obj_categories->where('product_type', $product_type);
	}
	$obj_categories = $obj_categories->get();

	if($obj_categories)
	{
		$arr_categories = $obj_categories->toArray();
	}	
	return $arr_categories;
}

/*
| Function  : Get subcategories and productline from given category id and product id
| Author    : Deepak Arvind Salunke
| Date      : 15/05/2018
| Output    : List of subcategories and productline from given category id and product id
*/

function get_subcategories_productline($category_id = false, $product_type = false)
{
	$obj_subcategories_productline = [];

	$obj_sub_categories = SubCategoryModel::select('id','subcategory_name','slug')
	->orderBy('id','ASC')
	->where('status','1');

	// get by category id
	if($category_id != null)
	{
		$obj_sub_categories = $obj_sub_categories->where('category_id', $category_id);
	}

	// get by product type
	if($product_type != null)
	{
		$obj_sub_categories = $obj_sub_categories->where('product_type', $product_type);
	}

	$obj_sub_categories = $obj_sub_categories->get();

	if($obj_sub_categories)
	{
		$arr_sub_categories = $obj_sub_categories->toArray();

		if(count($arr_sub_categories) > 0)
		{
			foreach($arr_sub_categories as $key => $arr_sub)		
			{
				$obj_subcategories_productline[$key]['subcategory_id'] 	 = $arr_sub['id'];
				$obj_subcategories_productline[$key]['subcategory_name'] = $arr_sub['subcategory_name'];
				$obj_subcategories_productline[$key]['subcategory_slug'] = $arr_sub['slug'];

				$obj_product_lines = ProductLinesModel::where('status','1')->orderBy('id','ASC');

				// get by category id
				if($category_id != null)
				{
					$obj_product_lines = $obj_product_lines->where('category_id', $category_id);
				}

				// get by sub category id
				if($arr_sub['id'] != null)
				{
					$obj_product_lines = $obj_product_lines->where('sub_category_id', $arr_sub['id']);
				}

				// get by product type
				if($product_type != null)
				{
					$obj_product_lines = $obj_product_lines->where('product_type', $product_type);
				}

				$obj_product_lines = $obj_product_lines->get();

				if($obj_product_lines)
				{
					$arr_product_lines = $obj_product_lines->toArray();
					$obj_subcategories_productline[$key]['arr_product_lines'] = $arr_product_lines;
				}
			}
		}
	}
	return $obj_subcategories_productline;

} // end get_subcategories_productline


/*
| Function  : Get subcategory and category data from given subcategory slug
| Author    : Deepak Arvind Salunke
| Date      : 15/05/2018
| Output    : Show subcategory and category data from given subcategory slug
*/

function get_category_sub_data($slug = false)
{
	$arr_sub_categories = [];

	$obj_sub_categories = SubCategoryModel::with('get_category')
	->orderBy('subcategory_name','ASC')
	->where('status','1');

	// get by sub category slug
	if($slug != null)
	{
		$obj_sub_categories = $obj_sub_categories->where('slug', $slug);
	}

	$obj_sub_categories = $obj_sub_categories->first();

	if($obj_sub_categories)
	{
		$arr_sub_categories = $obj_sub_categories->toArray();
	}
	return $arr_sub_categories;
} // end get_category_sub_data


/*
| Function  : Get product line, subcategory and category data from given product line slug
| Author    : Deepak Arvind Salunke
| Date      : 15/05/2018
| Output    : Show product line, subcategory and category data from given product line slug
*/

function get_category_sub_line_data($slug = false)
{
	$arr_product_lines = [];

	$obj_product_lines = ProductLinesModel::with('category', 'sub_category')
	->orderBy('product_line_name','ASC')
	->where('status','1');

	// get by product line slug
	if($slug != null)
	{
		$obj_product_lines = $obj_product_lines->where('slug', $slug);
	}

	$obj_product_lines = $obj_product_lines->first();

	if($obj_product_lines)
	{
		$arr_product_lines = $obj_product_lines->toArray();
	}
	return $arr_product_lines;
} // end get_category_sub_line_data


/*
| Author    : Deepak Bari
| Function  : Get the specific phone code by id or get all phone codes 
*/


function get_phonecode($id = false)
{
	$obj_phonecode = "";

	$arr_phonecode = [];
	$obj_phonecode = CountryModel::orderBy('CountryCode')->get(['id','phonecode','CountryCode']);

	if($id != false)
	{
		$obj_phonecode = $obj_phonecode->where('id',$id)->first();
	}
	else
	{
		$obj_phonecode = $obj_phonecode->unique('phonecode');
	}

	if($obj_phonecode)
	{
		$arr_phonecode = $obj_phonecode->toArray();

	}
	return $arr_phonecode;	
}

/*
| Author    : Deepak Bari
| Function  : Get categories by product type.
*/

function get_category_by_product_type($product_type_id = false)
{
	if($product_type_id != false)
	{	
		$arr_categories = [];

		$obj_categories = CategoryModel::where('product_type', $product_type_id)
		->where('status','1')
		->select('id','category_name','slug')
		->get();
		if($obj_categories)
		{
			$arr_categories = $obj_categories->toArray();
			return $arr_categories;
		}
	}
	else
	{
		return false;
	}
}

/*
| Author    : Deepak Bari
| Function  : Admin side - Get unread message count.
*/

function get_admin_unread_notifications()
{
	$obj_notifications = NotificationsModel::where('receiver_user_type','1')
	->where('is_read','0')
	->orderBy('created_at','DESC')
	->get();

	if($obj_notifications)
	{
		return $obj_notifications->toArray();
	}
	else
	{
		return false;
	}
}

/*
| Author    : Deepak Bari
| Function  : Supplier - Get unread message count.
*/

function get_supplier_unread_notifications()
{	
	$login_supplier_id = 0;
	$login_supplier_id = login_user_id('supplier');

	$obj_notifications = NotificationsModel::where([
		'is_read'            => '0',
		'receiver_user_type' => '3',
		'receiver_user_id'   => $login_supplier_id
		])
	->orderBy('created_at','DESC')
	->get();

	if($obj_notifications)
	{
		return $obj_notifications->toArray();
	}
	else
	{
		return false;
	}
}

/*
| Author    : Deepak Bari
| Function  : To check whether user is login or not. REturns true or false.
*/

function validate_login($type)
{
	$auth = auth()->guard($type); 
	$user_auth = false;
	if($auth->check())
	{
		$user_auth = $auth->check();
	}
	
	return $user_auth;
}

/*
| Author    : Deepak Bari
| Function  : Get login user details.
*/

function login_user_details($type)
{
	$auth = auth()->guard($type)->user();
	return $auth;
}

/*
| Author    : Deepak Bari
| Function  : Get login user id.
*/

function login_user_id($type=null)
{
	if($type !=null)
	{

	$user = auth()->guard($type)->user();

	if($user)
	{

	return $user->id;
	}

	
	}
}

function login_user_email($type)
{
	$email = auth()->guard($type)->user()->email;
	return $email;
}

function get_product_lines_by_sub_category($sub_category_id = false)
{
	if($sub_category_id != false)
	{	
		$arr_product_lines = [];

		$obj_product_lines = ProductLinesModel::where('sub_category_id', $sub_category_id)
		->where('status','1')
		->select('id','product_line_name')
		->get();
		if($obj_product_lines)
		{
			$arr_product_lines = $obj_product_lines->toArray();
			
			return $arr_product_lines;
		}
	}
	else
	{
		return false;
	}
}

function get_product_unique_uid() 
{
	$uid = generate_random_product_uid();

	$obj_data = ProductsModel::select('uid')->where('uid','LIKE',$uid.'%')
	->get();

	if($obj_data)
	{
		$arr_data = $obj_data->toArray();
	}

	if(isset($arr_data) && !empty($arr_data))
	{
		$uids = array_column($arr_data, 'uid');
	}

	if(isset($uids) && isset($uid) && in_array($uid, $uids))
	{
		$max = 0;

		while(in_array( ($uid . '-' . ++$max ), $uids) );

		$uid = generate_random_product_uid();
	}

	return $uid;

}

/*
| Author    : Deepak Bari
| Function  : Get random product uid
*/
function generate_random_product_uid()
{
	$size = 8;
	$alpha_key = '';
	$keys = range('a', 'z');

	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 2;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
}

/*
| Author    : Deepak Bari
| Function  : add product to wish list.
*/
function add_product_to_wish_list($arr_product = false)
{
	$is_already_added = $is_stored = '';

	if($arr_product != false)
	{
		$is_already_added = WishListModel::where([
			'user_id'    => $arr_product['user_id'],
			'product_id' => $arr_product['product_id'],
			])
		->count();

		if($is_already_added > 0)
		{
			return 'exist';
		}

		$is_stored = WishListModel::create($arr_product);
		
		if($is_stored)
		{
			return 'success';
		}
		else
		{
			return 'error';
		}

	}
	else
	{
		return 'error';
	}
}

/*
| Author    : Deepak Bari
| Date      : 19/05/2018
| Function  : Get the product attributes by single  or multiple product id's
*/

function get_prduct_attributes_data($id_or_ids = false)
{
	if($id_or_ids != false)
	{
		$obj_product = '';

		if(is_array($id_or_ids))
		{
			$obj_product = ProductsModel::whereIn('id' , $id_or_ids);
		}
		else
		{
			$obj_product = ProductsModel::where('id' , $id_or_ids);
		}
		
		$obj_product = $obj_product->with(['category' => function($query){
			$query->select('id','category_name','slug');
		}])
		->with(['sub_category' => function($query){
			$query->select('id','subcategory_name','market_orientation_markup','slug');
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
			$query->select('id','product_id','image');
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
		->with(['review_and_rating' => function($query){
			$query->select('product_id');
			$query->groupBy('product_id');
			$query->selectRaw('sum(rating) as total_rating');
			$query->selectRaw('count(id) as total_given_rating');
		}]);

		if(is_array($id_or_ids))
		{
			$obj_product = $obj_product->get();
		}
		else
		{
			$obj_product = $obj_product->first();
		}

		if($obj_product)
		{
			$arr_product = $obj_product->toArray();
			return $arr_product;
		}
		else
		{
			return '';
		}
	}
	
}

function update_final_price($product_id=null)
{
	$admin_commission    = '0';
	$additional_markup   = '0';
	$market_orientation  = '0';
	$transaction_charges = '0';
	$additional_markup   = '0';
	$market_orientation  = '0';
	$gst                 = '0';
	$discount            = '0';
	$status              = false;

	if($product_id!=null)
	{
		$obj_product = ProductsModel::where('id',$product_id)->first();

		if($obj_product)
		{

			$arr_product      = $obj_product->toArray();
			
			if($arr_product['added_by_user_type']==3)
			{
				$supplier_id  = $arr_product['added_by_user_id'];
				$obj_supplier = SupplierModel::where('id',$supplier_id)->first();

				if($obj_supplier)
				{
					$arr_supplier     = $obj_supplier->toArray();
					$admin_commission = $arr_supplier['admin_commission'];
				}
			}

			$product_price     = $arr_product['product_price'];
			$subcategory_id    = $arr_product['subcategory_id'];
			$discount          = $arr_product['discount'];
			$additional_markup = $arr_product['additional_markup'];

			$obj_subcategory = SubCategoryModel::where('id', $subcategory_id)->first();

			if($obj_subcategory)
			{
				$arr_subcategory    = $obj_subcategory->toArray();
				$market_orientation = $arr_subcategory['market_orientation_markup'];
			}

			$obj_site_setting = SiteSettingModel::select(['transaction_charges', 'gst'])->first();

			if($obj_site_setting)
			{
				$arr_site_setting    = $obj_site_setting->toArray();
				$gst                 = $arr_site_setting['gst'];
				$transaction_charges = $arr_site_setting['transaction_charges'];
			}

			$product_supplier_markup    = $product_price*(($admin_commission)/100);
			$product_trasaction_charges = $product_price*(($transaction_charges)/100);
			$product_additional_markup  = $product_price*(($additional_markup)/100);
			$product_market_orientation = $product_price*(($market_orientation)/100);
			$product_gst                = ($product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation)*(($gst)/100);
			$product_discount           = ($product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation + $product_gst)*(($discount)/100);

			$admin_price = $product_price + $product_supplier_markup;
			$base_price  = $product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation + $product_gst;
			$final_price = $product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation + $product_gst - $product_discount;

			$status      = ProductsModel::where('id',$product_id)->update(['base_price'=> $base_price, 'final_price'=>$final_price, 'admin_price'=>$admin_price ]);
			return $status;

		}
	}

	else
	{
		$obj_products = ProductsModel::get();
		
		if($obj_products)
		{
			$arr_products = $obj_products->toArray();
			
			foreach ($arr_products as $key => $arr_product) 
			{
				$admin_commission = '0';
				$product_id       = $arr_product['id'];
				
				if($arr_product['added_by_user_type']==3)
				{
					$supplier_id  = $arr_product['added_by_user_id'];
					$obj_supplier = SupplierModel::where('id',$supplier_id)->first();

					if($obj_supplier)
					{
						$arr_supplier     = $obj_supplier->toArray();
						$admin_commission = $arr_supplier['admin_commission'];
					}
				}

				$product_price     = $arr_product['product_price'];
				$subcategory_id    = $arr_product['subcategory_id'];
				$discount          = $arr_product['discount'];
				$additional_markup = $arr_product['additional_markup'];

				$obj_subcategory = SubCategoryModel::where('id', $subcategory_id)->first();

				if($obj_subcategory)
				{
					$arr_subcategory    = $obj_subcategory->toArray();
					$market_orientation = $arr_subcategory['market_orientation_markup'];
				}

				$obj_site_setting = SiteSettingModel::select(['transaction_charges', 'gst'])->first();

				if($obj_site_setting)
				{
					$arr_site_setting    = $obj_site_setting->toArray();
					$gst                 = $arr_site_setting['gst'];
					$transaction_charges = $arr_site_setting['transaction_charges'];
				}

				$product_supplier_markup    = $product_price*(($admin_commission)/100);
				$product_trasaction_charges = $product_price*(($transaction_charges)/100);
				$product_additional_markup  = $product_price*(($additional_markup)/100);
				$product_market_orientation = $product_price*(($market_orientation)/100);
				$product_gst                = ($product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation)*(($gst)/100);
				$product_discount           = ($product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation + $product_gst)*(($discount)/100);

				$admin_price = $product_price + $product_supplier_markup;
				$base_price  = $product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation + $product_gst;
				$final_price = $product_supplier_markup + $product_price + $product_trasaction_charges + $product_additional_markup + $product_market_orientation + $product_gst - $product_discount;
				$status      = ProductsModel::where('id',$product_id)->update(['base_price'=> $base_price, 'final_price'=>$final_price, 'admin_price'=>$admin_price ]);
			}
		}
		return $status;
	}

	/*\DB::select("update `products` set products.base_price = (product_price + 

		(((select site_settings.gst from `site_settings`)/100)*
		( product_price+

		(((select site_settings.transaction_charges from `site_settings`)/100)*product_price)+

		(((select subcategories.market_orientation_markup from `subcategories` where subcategories.id =subcategory_id)/100)*product_price)+


		(((select suppliers.admin_commission from `suppliers` where id =added_by_user_id)/100)*product_price)+

		(((additional_markup)/100)*product_price))

		)),

		products.final_price = (product_price-(((discount)/100)*base_price) + 

		(((select site_settings.gst from `site_settings`)/100)*
		( product_price+

		(((select site_settings.transaction_charges from `site_settings`)/100)*product_price)+

		(((select subcategories.market_orientation_markup from `subcategories` where subcategories.id =subcategory_id)/100)*product_price)+


		(((select suppliers.admin_commission from `suppliers` where id =added_by_user_id)/100)*product_price)+

		(((additional_markup)/100)*product_price))

		)),
		

		products.admin_price = (product_price + 
		(((select suppliers.admin_commission from `suppliers` where id =added_by_user_id)/100)*product_price)
		) where added_by_user_type = '3'"
		);


	\DB::select("update `products` set products.base_price = (product_price + 

		(((select site_settings.gst from `site_settings`)/100)*
		( product_price+

		(((select site_settings.transaction_charges from `site_settings`)/100)*product_price)+

		(((select subcategories.market_orientation_markup from `subcategories` where subcategories.id =subcategory_id)/100)*product_price)+

		(((additional_markup)/100)*product_price))

		)),

		products.final_price = (product_price-(((discount)/100)*base_price) + 

		(((select site_settings.gst from `site_settings`)/100)*
		( product_price+

		(((select site_settings.transaction_charges from `site_settings`)/100)*product_price)+

		(((select subcategories.market_orientation_markup from `subcategories` where subcategories.id =subcategory_id)/100)*product_price)+


		(((select suppliers.admin_commission from `suppliers` where id =added_by_user_id)/100)*product_price)+

		(((additional_markup)/100)*product_price))

		)),
		

		products.admin_price = (product_price + 
		(((select suppliers.admin_commission from `suppliers` where id =added_by_user_id)/100)*product_price)
		) where added_by_user_type = '1'"
		);*/
	}


	function get_unique_gift_card_code() 
	{
		$code = generate_random_gift_card_code();

		$obj_data = UserGiftCardModel::select('gift_card_code')->where('gift_card_code','LIKE',$code.'%')
		->get();

		if($obj_data)
		{
			$arr_data = $obj_data->toArray();
		}

		if(isset($arr_data) && !empty($arr_data))
		{
			$arr_gift_cards = array_column($arr_data, 'gift_card_code');
		}

		if(isset($arr_gift_cards) && isset($code) && in_array($code, $arr_gift_cards))
		{
			$max = 0;

			while(in_array( ($code . '-' . ++$max ), $arr_gift_cards) );

			$code = generate_random_gift_card_code();
		}

		return $code;
	}

	function generate_random_gift_card_code()
	{
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$res = "";

		for ($i = 0; $i < 12; $i++)
		{
			$res .= $chars[mt_rand(0, strlen($chars)-1)];
		}

		return $res;
	}


	function get_current_dollar_value($category_id=null)
	{
		$obj_currency = SiteSettingModel::select('currency_rate')->first();

		if($obj_currency)
		{
			return isset($obj_currency->currency_rate) ? $obj_currency->currency_rate : 0;
		}
	}

	function get_order_count($user_id=null)
	{
		$count = '0';

		if($user_id!=null)
		{
			$count = OrdersModel::where('user_id',$user_id)->whereHas('transaction', function($q){
            $q->where('payment_status','!=','0');
        })->count();
		}
		return $count;
	}

	function replacement_order_count($user_id=null)
	{
		$count = '0';

		if($user_id!=null)
		{
			$count = ReplacementProductRequestModel::where('user_id',$user_id)->count();
		}
		return $count;
	}

	function formatted_trasaction_date($date=null)
	{
		$formatted_date = '--';

		if($date!=null && $date!='')
		{
			$date = strtotime($date);
			$formatted_date = date('M-d-Y h:i a', $date);
		}

		return $formatted_date;

	}

	function get_subcategories_by_most_products($no_of_sub_categories = false,$category_id = false)
	{
		$arr_sub_categories = [];

		$obj_sub_categories = SubCategoryModel::whereHas('products' , function($query) use($category_id){
			$query->select('id','subcategory_id','category_id');
			$query->selectRaw('count(id) as total_products');
			$query->groupBy('subcategory_id');
			$query->where('category_id',$category_id);
			$query->where('admin_approval','1');
			$query->where('status','1');
		})
		->with(['products' => function($query) use($category_id){
			$query->select('id','subcategory_id','category_id');
			$query->selectRaw('count(id) as total_products');
			$query->groupBy('subcategory_id');
			$query->where('category_id',$category_id);
			$query->where('admin_approval','1');
			$query->where('status','1');
		}])
		->where('category_id',$category_id)
		->take($no_of_sub_categories)->inRandomOrder()->get();

		if($obj_sub_categories)
		{
			$arr_sub_categories = $obj_sub_categories->toArray();

			return $arr_sub_categories;
		}

		return false;

	}

	function get_supplier_earning($order_id=null)
	{
		$total = '0';
		if($order_id!=null)
		{

			$obj_total = \DB::select("SELECT SUM(`product_price`*`product_quantity`) AS 'order_sum' FROM `order_product` WHERE order_id ='".$order_id."'");
			$total = $obj_total[0]->order_sum;
		}
		return $total;
	}

	function get_supplier_my_earning($order_id=null)
	{
		$supplier_id = login_user_id('supplier');
		$total = '0';
		if($order_id!=null && $supplier_id!=null)
		{

			$obj_total = \DB::select("SELECT SUM(`product_price`*`product_quantity`) AS 'order_sum' FROM `order_product` WHERE order_id ='".$order_id."' AND product_supplier_id ='".$supplier_id."'");
			$total = $obj_total[0]->order_sum;
		}
		return $total;
	}

	function get_admin_earning($order_id=null)
	{
		$total = '0';
		if($order_id!=null)
		{

			$obj_total = \DB::select("SELECT SUM(`product_price`*`product_quantity`) AS 'order_sum' FROM `order_product` WHERE order_id ='".$order_id."'");

			$obj_final_total = \DB::select("SELECT SUM(`product_final_price`*`product_quantity`) AS 'order_sum' FROM `order_product` WHERE order_id ='".$order_id."'");
			$total = $obj_final_total[0]->order_sum-$obj_total[0]->order_sum;
		}
		return $total;
	}

	function get_gst_percent()
	{
		$obj_site_setting = SiteSettingModel::where('id','1')->select('gst')->first();

		if($obj_site_setting)
		{
			return isset($obj_site_setting->gst) && !empty($obj_site_setting->gst) ? $obj_site_setting->gst : 0;
		}

		return false;
	}

	function get_order_insurance($order_id=null)
	{
		$count = 0;
		if($order_id!=null)
		{
			$obj_orders = OrdersProductModel::where('order_id',$order_id)->get();

			if($obj_orders)
			{
				$arr_orders = $obj_orders->toArray();


				foreach ($arr_orders as $key => $product) 
				{
					$count +=$product['insurance_on_product']*$product['product_quantity'];
				}	
			}
		}
		return $count;
	}


	?>
