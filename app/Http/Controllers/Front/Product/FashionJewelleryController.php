<?php

namespace App\Http\Controllers\Front\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\ProductFilterService;

use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductLinesModel;

use App\Models\MetalsModel;
use App\Models\GemStoneModel;
use App\Models\OccasionsModel;
use App\Models\CollectionModel;
use App\Models\LookModel;
use App\Models\ProductsModel;
use App\Models\SettingModel;
use App\Models\MetalDetailingModel;
use App\Models\ShankTypeModel;
use App\Models\RingShoulderModel;
use App\Models\BandSettingModel;
use App\Models\ProductSizesModel;
use App\Models\ProductMetalsModel;
use App\Models\ProductImagesModel;
use App\Models\ProductGemStoneModel;
use App\Models\InsuranceDetailsModel;
use App\Models\WishListModel;

use DB;
use Session;
use Cookie;

class FashionJewelleryController extends Controller
{
	public function __construct(
       CategoryModel        $category_model,
       SubCategoryModel     $subcategory_model,
       ProductLinesModel    $productlines_model,
       MetalsModel          $metals_model,
       GemStoneModel        $gemstone_model,
       OccasionsModel       $occasions_model,
       CollectionModel      $collection_model,
       LookModel            $look_model,
       ProductsModel        $products_model,
       SettingModel         $setting_model,
       MetalDetailingModel  $metaldetailing_model,
       ShankTypeModel       $shanktype_model,
       RingShoulderModel    $ringshoulder_model,
       BandSettingModel     $bandsetting_model,
       ProductSizesModel    $product_sizes_model,
       ProductMetalsModel   $product_metals_model,
       ProductImagesModel   $product_images_model,
       ProductGemStoneModel $product_gem_stone_model,
       ProductFilterService $product_filter_service,
       WishListModel        $wish_list_model
       )
	{
		$this->arr_view_data             = [];
		$this->module_title              = "Fashion Jewellery";
		$this->module_category           = "fashion-jewellery";
		$this->module_view_folder        = "front.products";
		$this->ProductSizesModel         = $product_sizes_model;
		$this->ProductMetalsModel        = $product_metals_model;
		$this->ProductImagesModel        = $product_images_model;
		$this->CategoryModel             = $category_model;
		$this->SubCategoryModel          = $subcategory_model;
		$this->ProductLinesModel         = $productlines_model;
		$this->MetalsModel               = $metals_model;
		$this->GemStoneModel             = $gemstone_model;
		$this->OccasionsModel            = $occasions_model;
		$this->CollectionModel           = $collection_model;
		$this->LookModel                 = $look_model;
		$this->SettingModel              = $setting_model;
		$this->MetalDetailingModel       = $metaldetailing_model;
		$this->ShankTypeModel            = $shanktype_model;
		$this->RingShoulderModel         = $ringshoulder_model;
		$this->BandSettingModel          = $bandsetting_model;
		$this->ProductsModel             = $products_model;
		$this->ProductGemStoneModel      = $product_gem_stone_model;
		$this->ProductFilterService      = $product_filter_service;
        $this->WishListModel             = $wish_list_model;

        $this->front_url_path            = url('/');
        $this->module_url_path           = $this->front_url_path."/fashion-jewellery";

        $this->product_image_base_path   = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_path = url('/').config('app.project.img_path.product_images');

        $this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');

        DB::connection()->enableQueryLog();
    }

    public function index()
    {
        $arr_subcategory = []; 
        
        $obj_subcategory = $this->SubCategoryModel->where('category_id','3')->limit('4')->get(['subcategory_name','description', 'image', 'slug']);
        
        if($obj_subcategory)
        {
            $arr_subcategory = $obj_subcategory->toArray();
        }

        $arr_random_subcategory = []; 
        
        $obj_random_subcategory = $this->SubCategoryModel->where('category_id','3')->inRandomOrder()->limit('2')->get(['subcategory_name','description', 'image', 'slug']);
        
        if($obj_random_subcategory)
        {
            $arr_random_subcategory = $obj_random_subcategory->toArray();
        }

        $this->arr_view_data['arr_random_subcategory'] = $arr_random_subcategory;
        $this->subcategory_image_base_path                  = base_path().config('app.project.img_path.sub_category_image');
        $this->subcategory_image_public_path                  = url('/').config('app.project.img_path.sub_category_image');
        $this->arr_view_data['subcategory_image_base_path'] = $this->subcategory_image_base_path;
        $this->arr_view_data['subcategory_image_public_path'] = $this->subcategory_image_public_path;
        $this->arr_view_data['arr_subcategory']             = $arr_subcategory;
        $this->arr_view_data['page_title']                  = 'Fashion Jewellery';
        
        return view($this->module_view_folder.'.fashion_jewellery_landing',$this->arr_view_data);
    }

	/*
    | Function  : Get all the products under this sub category
    | Author    : Deepak Arvind Salunke
    | Date      : 15/05/2018
    | Output    : Listing all the products under this sub category
    */


    public function products_listing($sub_category_slug = false, $product_line_slug = false, Request $request)
    {
      $category_slug = $this->module_category;

      $arr_category_sub_data = $arr_category_sub_line_data = $product_line = $sub_category = $category = $get_productline_data = $arr_products = $arr_wishlist = [];

      if($product_line_slug != null)
      {
         $arr_category_sub_line_data = get_category_sub_line_data($product_line_slug);

         if($arr_category_sub_line_data != null)
         {
            $product_line 	= $arr_category_sub_line_data;
            $sub_category 	= $arr_category_sub_line_data['sub_category'];
            $category 		= $arr_category_sub_line_data['category'];
        }
        else
        {
            return $this->products_details($sub_category_slug, $product_line_slug);
        }
    }
    else if($sub_category_slug != null)
    {
     $arr_category_sub_data = get_category_sub_data($sub_category_slug);

     if($arr_category_sub_data)
     {
        $sub_category 	= $arr_category_sub_data;
        $category 		= $arr_category_sub_data['get_category'];
    }
    else
    {
        return response()->view('errors.404', [], 404);
    }
}

if($sub_category_slug != null)
{
 $obj_productline_data = $this->ProductLinesModel->where('category_id', $category['id'])
 ->where('sub_category_id', $sub_category['id'])
 ->where('status', '1')
 ->where('product_type', '1')
 ->orderBy('product_line_name','ASC')
 ->get();
 if($obj_productline_data)
 {
    $get_productline_data = $obj_productline_data->toArray();
}
}

$this->arr_view_data['arr_productfilters'] = $this->ProductFilterService->get_filters_data();


		// Get product listing 
$obj_products = $this->ProductsModel->with('category', 'sub_category', 'product_line', 'product_images')
->whereHas('category', function($cat_query) use ($category){
    $cat_query->where('slug', $category['slug']);
})
->whereHas('sub_category', function($sub_query) use ($sub_category){
    $sub_query->where('slug', $sub_category['slug']);
})
->where(['admin_approval'=> '1' , 'status' => '1']);

		// for product line
if($product_line != null && !empty($product_line))
{
 $obj_products = $obj_products->with('product_line')
 ->whereHas('product_line', function($line_query) use ($product_line){
     $line_query->where('slug', $product_line['slug']);
 });
}									

$result_filters = $this->ProductFilterService->apply_filters($request->all(), $obj_products);

if(isset($result_filters) && !empty($result_filters))
{
 $this->arr_view_data['result_filters'] = $result_filters['applied_filters'];
 $obj_products                          = $result_filters['obj_products'];
}

$obj_products = $obj_products->paginate(20);

if($obj_products)
{
 $arr_products = $obj_products->toArray();
 $arr_pagination = clone $obj_products;
}

$is_login = validate_login('user');
if($is_login)
{
    $user_id = login_user_id('user');

    $obj_wishlist = $this->WishListModel->where('user_id', $user_id)->select('product_id')->get();
    if($obj_wishlist)
    {
        $arr_wishlist = $obj_wishlist->toArray();
    }
}

$queries = DB::getQueryLog();
		//dd($arr_products['data']);

$this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
$this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

$this->arr_view_data['arr_products']              = $arr_products;
$this->arr_view_data['arr_pagination']            = $arr_pagination;
$this->arr_view_data['productline_data']          = $get_productline_data;
$this->arr_view_data['product_line']              = $product_line;
$this->arr_view_data['sub_category']              = $sub_category;
$this->arr_view_data['category']                  = $category;
$this->arr_view_data['arr_wishlist']              = $arr_wishlist;


if($product_line_slug != null)
{
 $this->arr_view_data['module_url_path']        	= $this->module_url_path.'/'.$sub_category_slug.'/'.$product_line_slug;
}
else
{
 $this->arr_view_data['module_url_path']        	= $this->module_url_path.'/'.$sub_category_slug;
}

$this->arr_view_data['page_title']             		= $this->module_title;

return view($this->module_view_folder.'.fashion_jewellery',$this->arr_view_data);

	} // end products_listing



	/*
    | Function  : Get details of the selected product
    | Author    : Sagar Pawar
    | Date      : 17/05/2018
    | Output    : Show details of the selected product
    */

    public function products_details($sub_category_slug = false, $product_slug = false)
    {
        $arr_product            = [];
        $arr_product_sizes      = [];
        $arr_product_metals     = [];
        $arr_product_images     = [];
        $arr_insurance_details  = [];
        $arr_similer_find       = [];
        $arr_similar_product    = [];
        $arr_compare_product_id = [];
        $arr_wishlist           = [];

        $obj_product = $this->ProductsModel

        ->with(['category'=>function($q) { $q->select('id','category_name'); }])
        ->with(['sub_category'=>function($q) { $q->select('id','subcategory_name'); }])
        ->with(['product_line'=>function($q){ $q->select('id','product_line_name'); }])
        ->with(['brand'=>function($q){ $q->select('id','brand_name'); }])
        ->with('reviews_and_ratings.user_details')
        ->with(['reviews_and_ratings' => function($query){
            $query->orderBy('created_at','DESC');
        }])
        ->where('slug',$product_slug)->first();

        if($obj_product)
        {
            $arr_product      = $obj_product->toArray();    
// dd($arr_product);
            $arr_similer_find['product_line_id'] = $arr_product['product_line_id'];

            $product_id  = $arr_product['id'];

            $obj_product_sizes = $this->ProductSizesModel->where('product_id',$product_id)->get(['id','size_name']);

            if($obj_product_sizes)
            {
                $arr_product_sizes = $obj_product_sizes->toArray();             
            }

            $obj_product_metals = $this->ProductMetalsModel->with(['metal_name'=>function($q){ $q->select(['id','metal_name']); },
                'metal_color'=>function($q){ $q->select(['id','metal_color']); },
                'metal_quality'=>function($q){ $q->select(['id','quality_name']); }])
            ->where('product_id',$product_id)
            ->get(['id','metal_name_id','metal_color_id','metal_quality_id','product_id']);

            if($obj_product_metals)
            {
                $arr_product_metals = $obj_product_metals->toArray();   
            }

            $obj_product_images = $this->ProductImagesModel->where('product_id',$product_id)->get(['image']);

            if($obj_product_images)
            {
                $arr_product_images = $obj_product_images->toArray();
            }

            $obj_product_gemstone = $this->ProductGemStoneModel->with(['gemstone_type'=>function($q){ $q->select(['id','type']); }, 
                'gemstone_color'=>function($q){ $q->select(['id', 'gemstone_color']); },
                'gemstone_quality'=>function($q){ $q->select(['id','gemstone_quality']); },
                'gemstone_shape'=>function($q){ $q->select(['id', 'shape_name']); }])
            ->where('product_id', $product_id)->get(['id','gemstone_type_id','gemstone_color_id','gemstone_quality_id','gemstone_shape_id']);

            if($obj_product_gemstone)
            {
                $arr_product_gemstone = $obj_product_gemstone->toArray();

            // dd($arr_product_gemstone);
            }

            $obj_insurance_details = InsuranceDetailsModel::where('status','1')->get(['id','company_name','price','description']);

            if($obj_insurance_details)
            {
                $arr_insurance_details = $obj_insurance_details->toArray();
            }

            $obj_similar_product = $this->ProductsModel
            ->with(['product_images'=>function($q) { $q->select(['image', 'product_id'])->first(); }])
            ->with(['category'=>function($q){ $q->select('id', 'slug');}])
            ->with(['sub_category'=>function($q){ $q->select('id', 'slug');}])
            ->where($arr_similer_find)->whereNotIn('id',[$arr_product['id']])->get(['id', 'category_id', 'subcategory_id','product_name', 'slug' ,'product_price'])->take(4);

            if($obj_similar_product)
            {
                $arr_similar_product = $obj_similar_product->toArray(); 
            }

            $is_login = validate_login('user');

            if($is_login)
            {
                $user_id = login_user_id('user');

                $obj_wishlist = $this->WishListModel->where('user_id', $user_id)
                ->where('product_id',$product_id)
                ->select('product_id')
                ->first();

                if($obj_wishlist)
                {
                    $arr_wishlist = $obj_wishlist->toArray();
                }
            }

            $this->arr_view_data['user_profile_image_base_path']     = $this->user_profile_image_base_path;
            $this->arr_view_data['user_profile_image_public_path']   = $this->user_profile_image_public_path;

            increment_view_count($arr_product['id']);

            $this->arr_view_data['arr_wishlist']              = $arr_wishlist;
            $this->arr_view_data['arr_product']               = $arr_product;
            $this->arr_view_data['arr_product_sizes']         = $arr_product_sizes;
            $this->arr_view_data['arr_product_metals']        = $arr_product_metals;
            $this->arr_view_data['arr_product_images']        = $arr_product_images;
            $this->arr_view_data['arr_similar_product']       = $arr_similar_product;
            $this->arr_view_data['arr_product_gemstone']      = $arr_product_gemstone;
            $this->arr_view_data['arr_insurance_details']     = $arr_insurance_details;
            $this->arr_view_data['arr_compare_product_id']    = $arr_compare_product_id;

            $this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;
            $this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;

            $this->arr_view_data['page_title']                = "View Product";
            $this->arr_view_data['module_url_path']           = url($this->module_category.'/'.$sub_category_slug);

            return view($this->module_view_folder.'.view_jewellery',$this->arr_view_data);

        }
        else
        {
            return response()->view('errors.404', [], 404); 
        }
    } 

    /*
    | Author    : Deepak Bari
    | Date      : 18/05/2018
    | Function  : Add product to wish list.
    */

    public function add_product_to_wish_list($enc_product_id = false)
    {
    	$arr_return = $arr_product = [];
    	$is_stored = $login_user_id = '';
    	if($enc_product_id != false)
    	{
    		if(validate_login('user'))
    		{
    			$login_user_id = login_user_id('user');
    		}
    		else
    		{	
    			$arr_return['status'] = 'error';
    			$arr_return['msg']    = 'Please login to add product to wishlist.';

    			return $arr_return;
    		}

    		$arr_product['product_type']   = 1;
    		$arr_product['product_id']     = base64_decode($enc_product_id);
    		$arr_product['user_id']        = $login_user_id;

    		$is_stored = add_product_to_wish_list($arr_product);

    		if($is_stored == 'exist')
    		{
    			$arr_return['status'] = 'error';
    			$arr_return['msg']    = 'This product is already added to your wishlist.';
    		}
    		else if($is_stored == 'success')
    		{
    			$arr_return['status'] = 'success';
    			$arr_return['msg']    = 'Product added to wishlist successfully.';
    		}
    		else if($is_stored == 'error')
    		{
    			$arr_return['status'] = 'error';
    			$arr_return['msg']    = 'Something went to wrong! Please try again later.';
    		}
    	}
    	else
    	{
    		$arr_return['status'] = 'error';
    		$arr_return['msg']    = 'Something went to wrong! Please try again later.';
    	}

    	return $arr_return;

    }

    public function add_product_to_compare_list($enc_product_id = false)
    {
    	

    	$arr_return = $arr_compare = [];

    	$sub_cat_id = '';
    	
    	if($enc_product_id != false)
    	{
    		$product_id                    = base64_decode($enc_product_id);

    		$obj_product = ProductsModel::where('id',$product_id)->select('subcategory_id')->first();

    		if($obj_product)
    		{
    			$sub_cat_id = isset($obj_product->subcategory_id) ? $obj_product->subcategory_id : '';
    		}

    		$arr_product['product_id'] = $product_id;
    		$arr_product['sub_cat_id'] = $sub_cat_id;
    		//dd($arr_product);
    		if(Session::has('arr_compare'))
    		{
    			if(sizeof(Session::get('arr_compare')) >= 4)
    			{
    				$arr_return['status'] = 'error';
    				$arr_return['msg']    = 'You can\'t add more than 4 products in compare list.';

    				return $arr_return;
    			}

    			$arr_product_ids = array_column(Session::get('arr_compare'), 'product_id');

    			if(in_array($product_id, $arr_product_ids))
    			{
    				$arr_return['status'] = 'error';
    				$arr_return['msg']    = 'This product is already added in your compare list.';

    				return $arr_return;	
    			}
    			
    			$arr_compare            = Session::get('arr_compare');
    			$arr_compare[sizeof(Session::get('arr_compare'))] = $arr_product;

                Session::put('arr_compare',$arr_compare);
            }
            else
            {
             $arr_compare[0] = $arr_product;

             Session::put('arr_compare',$arr_compare);
         }

    		//Session::flush('arr_compare');
         \Session::save();

         //dd(Session::get('arr_compare'));






     }
     else
     {
      $arr_return['status'] = 'error';
      $arr_return['msg']    = 'Something went to wrong! Please try again later.';
  }

  return $arr_return;

}

}
