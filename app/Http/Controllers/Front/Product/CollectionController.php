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
use App\Models\WishListModel;

use DB;

class CollectionController extends Controller
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
		$this->module_title              = "Collection";
		$this->module_category           = "collection";
		$this->module_view_folder        = "front.products.collection";
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
		$this->module_url_path            = $this->front_url_path."/collection";
		$this->collection_image_base_path = base_path().config('app.project.img_path.collection_image');

		$this->product_image_base_path   = base_path().config('app.project.img_path.product_images');
		$this->product_image_public_path = url('/').config('app.project.img_path.product_images');

		DB::connection()->enableQueryLog();
	}


	public function index()
	{
		$obj_collection = $this->CollectionModel->where('status','1')->paginate('6');
		$arr_collection = [];
		if($obj_collection)
		{
			$arr_collection = $obj_collection->toArray();
		}
		$arr_pagination                                    = $obj_collection;
		$this->arr_view_data['page_title']                 = 'Collection';
		$this->arr_view_data['collection_image_base_path'] = $this->collection_image_base_path;
		$this->arr_view_data['arr_collection']             = isset($arr_collection['data'])? $arr_collection['data']:[];
		$this->arr_view_data['arr_pagination']             = $arr_pagination;
		return view($this->module_view_folder.'.collection_landing',$this->arr_view_data);
	}
	
	/*
    | Function  : Get all the products accroding to search keywords
    | Author    : Deepak Arvind Salunke
    | Date      : 19/05/2018
    | Output    : Listing all the products accroding to search keywords
    */

    public function collection($collection_slug = false, Request $request)
    {
    	$arr_category = $arr_subcategory = $arr_products = $arr_pagination = $sub_category = $category = $arr_wishlist = [];

		// get collection data
    	$obj_collection = $this->CollectionModel->where("slug", $collection_slug)
    	->where("status", "1")
    	->first();
    	if($obj_collection)
    	{
    		$this->arr_view_data['arr_collection_data'] = $obj_collection->toArray();
    	}

    	$this->arr_view_data['arr_productfilters'] = $this->ProductFilterService->get_filters_data();


    	$obj_products = $this->ProductsModel;

		// get products using collection slug
    	if($collection_slug != null && !empty($collection_slug))
    	{
    		$obj_products = $obj_products->whereHas("product_collections.collection", function($qcollection) use ($collection_slug){
    			$qcollection->where('slug', $collection_slug);
    		});
    	}


    	$result_filters = $this->ProductFilterService->apply_filters($request->all(), $obj_products);

    	if(isset($result_filters) && !empty($result_filters))
    	{
    		$this->arr_view_data['result_filters'] = $result_filters['applied_filters'];
    		$obj_products                          = $result_filters['obj_products'];
    	}

    	$obj_products = $obj_products->with('category', 'sub_category', 'product_line', 'product_images')
    	->where('admin_approval', '1')->where('status', '1');

    	$obj_products = $obj_products->paginate(20);

    	if($obj_products)
    	{
    		$arr_products = $obj_products->toArray();
    		$arr_pagination = clone $obj_products;
    	}
    	else
    	{
    		return response()->view('errors.404', [], 404);
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
		//dd($arr_products);

    	$this->arr_view_data['arr_products']              = $arr_products;
    	$this->arr_view_data['arr_pagination']            = $arr_pagination;

    	$this->arr_view_data['sub_category']              = $sub_category;
    	$this->arr_view_data['category']                  = $category;
    	$this->arr_view_data['arr_wishlist']              = $arr_wishlist;

    	$this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
    	$this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

    	$this->arr_view_data['module_url_path']           = $this->module_url_path.'/'.$collection_slug;
    	$this->arr_view_data['page_title']                = $this->module_title;

    	return view($this->module_view_folder.'.index',$this->arr_view_data);

	} // end index

}
