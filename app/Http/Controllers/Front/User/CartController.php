<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\CartService;
use App\Common\Services\GiftCardService;
use App\Common\Services\OtpService;

use App\Models\ShoppingCartModel;

use App\Models\CartProductModel;
use Session;

use URL;

class CartController extends Controller
{
	public function __construct(
		CartService       $cart_service,
		GiftCardService   $gift_card_service,
		CartProductModel  $cart_product_model,
		ShoppingCartModel $shopping_cart_model,
		OtpService        $otp_service
		)
	{

		$this->OtpService         = $otp_service;
		$this->arr_view_data      = [];
		$this->CartService        = $cart_service;
		$this->module_title       = 'Shopping Cart';
		$this->module_view_folder = "front.user.cart";
		$this->GiftCardService    = $gift_card_service;
		$this->CartProductModel   = $cart_product_model;
		$this->ShoppingCartModel  = $shopping_cart_model;
		$this->module_url_path    = url('/').'/shopping_cart';
		$this->product_image_base_path   = base_path().config('app.project.img_path.product_images');
	}

	public function index(Request $request)
	{
		update_final_price();
		$arr_cart_product = [];
		$user_id          = login_user_id('user');
		$obj_cart         = $this->ShoppingCartModel->where('user_id', $user_id)->select('id')->first();

		if($obj_cart)
		{
			$obj_cart_product = $this->CartProductModel
/*			->with(['product_details'=>function($q)
			{
				$q->select(['id','category_id', 'subcategory_id','product_name','final_price', 'base_price','slug'])->orderBy('id','DESC');
			}
			])*/
			->with(['insurance_details'=>function($q)
			{
				$q->select('id','price');
			}
			])->with(['product_image'=>function($q){
				$q->select('product_id','image');
			}])
			->with(['size_details'=>function($q){
				$q->select(['id','size_name']);
			}])

			->with('product_details.category')
			->with('product_details.sub_category')

			->with(['product_metals.metal_name'=>function($q)
			{
				$q->select(['id', 'metal_name']);
			}
			,'product_metals.metal_color'=>function($q)
			{
				$q->select(['id', 'metal_color']);
			}
			,'product_metals.metal_quality'=>function($q)
			{
				$q->select(['id', 'quality_name']);
			}
			])

			->with(['product_gemstone.gemstone_type'=>function($q)
			{
				$q->select(['id', 'type']);
			}
			,'product_gemstone.gemstone_color'=>function($q)
			{
				$q->select(['id', 'gemstone_color']);
			}
			,'product_gemstone.gemstone_quality'=>function($q)
			{
				$q->select(['id', 'gemstone_quality']);
			},'product_gemstone.gemstone_shape'=>function($q)
			{
				$q->select(['id','shape_name']);
			}
			])

			->where('cart_id',$obj_cart->id)->get(['id','cart_id','product_id','product_size_id','product_insurance_id','product_quantity','product_metal_id', 'product_gemstone_id']);
			
			if($obj_cart_product)
			{
				$arr_cart_product = $obj_cart_product->toArray();
			}
		}

		// dd($arr_cart_product);

		$this->arr_view_data['module_url_path']         = $this->module_url_path;
		$this->arr_view_data['page_title']              = $this->module_title;
		$this->arr_view_data['arr_cart_product']        = $arr_cart_product;
		$this->arr_view_data['product_image_base_path'] = $this->product_image_base_path;

		if($request->ajax()) {
			return view($this->module_view_folder.'.ajax_cart',$this->arr_view_data)->render();
		}

		return view($this->module_view_folder.'.index')->with($this->arr_view_data);
	}

	public function store(Request $request)
	{
		if(validate_login('user'))
		{
			$login_user_id = login_user_id('user');
		}
		else
		{	
			$prev_url = URL::previous();

			$prev_url = ltrim($prev_url, url('/'));	

			if (isset($prev_url) && ($prev_url!='')) 
			{
				Session::put('return_url',$prev_url);
			}

			$arr_return['status'] = 'error_login';
			return $arr_return;
		}

		if($request->input('is_name'))
		{
			if(!$request->input('name'))
			{
				$arr_return['status'] = 'error';
				$arr_return['msg']    = 'Please enter name on product.';
				return $arr_return;			

			}
		}

		$arr_product['user_id']          = $login_user_id;
		$arr_product['product_id']       = base64_decode($request->input('puid'));
		$arr_product['quantity']         = $request->input('quantity');
		$arr_product['product_size_id']  = base64_decode($request->input('product_size'));
		$arr_product['product_metal']    = base64_decode($request->input('metal'));
		$arr_product['product_gemstone'] = base64_decode($request->input('gemstone'));
		$arr_product['name_on_product']  = $request->input('name',null);

		if($request->has('insurance')){
			$arr_product['insurance_id']     = base64_decode($request->input('insurance',null));
		}

		$cart_status = $this->CartService->store($arr_product);

		if($cart_status)
		{
			$arr_return['status'] = 'success';
			$arr_return['count']  = $cart_status;
			$arr_return['msg']    = 'Product added to shopping cart successfully.';
			return $arr_return;
		}
		$arr_return['status'] = 'error';
		$arr_return['msg']    = 'Error while adding product to shopping cart';
		return $arr_return;
	}

	public function maximize_quantity($id) 
	{
		$id = base64_decode($id);
		$cart_product = $this->CartProductModel->where('id',$id)->select('product_quantity')->first();
		if($cart_product->product_quantity!=5)	
		{
			$status = $this->CartProductModel->where('id',$id)->increment('product_quantity');
			if($status)
			{
				return 'success';
			}
		}
		return 'error';
	}

	public function minimize_quantity($id) 
	{
		$id = base64_decode($id);
		$cart_product = $this->CartProductModel->where('id',$id)->select('product_quantity')->first();
		if($cart_product->product_quantity!=1)	
		{
			$status = $this->CartProductModel->where('id',$id)->decrement('product_quantity');

			if($status)
			{
				return 'success';
			}
		}
		return 'error';
	}

	public function remove_product($id) 
	{
		$id = base64_decode($id);
		$cart_product = $this->CartProductModel->where('id',$id)->delete();
		return 'success';
	}


	public function apply_giftcard($code=null)
	{
		if($code!=null)
		{
			$email             = login_user_email('user');
			$arr_data['email'] = $email;
			$arr_data['code']  = $code;
			$status = $this->GiftCardService->valiadte_code($arr_data);
			if($status)
			{
				$arr_return['status'] = 'success';
				return $arr_return;
			}
			$arr_return['status'] = 'error';
			return $arr_return;

		}
		$arr_return['status'] = 'error';
		return $arr_return;
	}

	function verify_otp(Request $request)
	{
		$arr_response = [];
		$code = $request->input('val_otp', null);

		if($code!=null)
		{
			$arr_data['user_id'] = login_user_id('user');
			$arr_data['otp']     = $code;
			
			$arr_response = $this->OtpService->verify_otp($arr_data);
			return $arr_response;
		}
		$arr_response['status']  = 'error';
		$arr_response['message'] = 'Something went wrong, please try again';
		return $arr_response;
	}

	function store_gift_card(Request $request)
	{
		$arr_response = [];
		$code         = $request->input('code', null);
		$user_id      = login_user_id('user');
		$email        = login_user_email('user');

		if($code!=null)
		{
			$arr_data['user_id'] = $user_id;
			$arr_data['email']   = $email;
			$arr_data['code']    = $code;
			$arr_response = $this->CartService->store_gift_card($arr_data);

			return $arr_response;
		}
		$arr_response['status']  = 'error';
		$arr_response['message'] = 'Something went wrong, please try again';
		return $arr_response;
	}

	public function addsession(Request $request)
	{
		$sess = $request->except(['_token','puid']);
		Session::flash('product_details', $sess);
	}
}
