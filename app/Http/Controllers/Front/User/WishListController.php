<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WishListModel;

use Session;

class WishListController extends Controller
{
	public function __construct(WishListModel $wishlist_tmodel)
	{

		$this->arr_view_data       = [];
		$this->user_panel_slug     = config('app.project.user_panel_slug');
		$this->user_url_path       = url(config('app.project.user_panel_slug'));
		$this->module_url_path     = $this->user_url_path;
		$this->module_title        = "Wishlist";
		
		$this->BaseModel           = $wishlist_tmodel;

		$this->module_view_folder  = "front.user.wishlist";

		$this->user_panel_slug = config('app.project.user_panel_slug');
		$this->user_url_path       = url(config('app.project.user_panel_slug'));
		$this->module_url_path     = $this->user_url_path."/wishlist";

		$this->product_image_base_path   	  = base_path().config('app.project.img_path.product_images');
		$this->product_image_public_path 	  = url('/').config('app.project.img_path.product_images');
	}

	/*
	| Author    : Deepak Bari
	| Function  : Display listing off wishlist products.
	*/

	public function index()
	{
		$arr_wishlist = $arr_pagination = [];
		$login_user_id = 0;
		$login_user_id = login_user_id('user');

		$obj_wishlist = $this->BaseModel->where([
			'product_type' => '1',
			'user_id'   => $login_user_id
		])
		->with(['product' => function($query){
			$query->select('id','product_name','product_price','slug');
		}])
		->with(['product.product_images' => function($query){
			$query->select('product_id','image');
		}])
		->with(['product.category' => function($query){
			$query->select('id','slug');
		}])
		->with(['product.sub_category' => function($query){
			$query->select('id','slug');
		}])
		->with(['product.review_and_rating' => function($query){
			$query->select('product_id');
	   		$query->groupBy('product_id');
    		$query->selectRaw('sum(rating) as total_rating');
    		$query->selectRaw('count(id) as total_given_rating');
		}])
		->orderBy('created_at','DESC')
		->paginate(10);

		if($obj_wishlist)
		{
			$arr_pagination   =  clone $obj_wishlist;
			$arr_wishlist = $obj_wishlist->toArray();
		}

		//dump($arr_wishlist['data']);

		$this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
		$this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;
		
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->user_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = $this->module_title;
		$this->arr_view_data['module_title']         = $this->module_title;
		
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['user_panel_slug']      = $this->user_panel_slug;
		$this->arr_view_data['arr_wishlist']            = $arr_wishlist;
		$this->arr_view_data['arr_pagination']            = $arr_pagination;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	/*
	| Author    : Deepak Bari
	| Function  : Remove specific product from wishlist.
	*/

	public function remove($enc_product_id = false)
	{
		if($enc_product_id != false)
		{
			$product_id = base64_decode($enc_product_id);

			$login_user_id = login_user_id('user');
			
			$status = $this->BaseModel->where([
												'product_id' => $product_id,
												'user_id'   => $login_user_id
											 ])->delete();

			if($status)
			{
				 Session::flash('success','Product removed successfully from '.str_singular($this->module_title).'.');
			}
			else
			{
				 Session::flash('error','Something went to wrong while removing product from '.str_singular($this->module_title));
			}
		}
		else
		{
			 Session::flash('error','Something went to wrong while removing product from '.str_singular($this->module_title));
             
		}
		return redirect()->back();
	}

}
