<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ReviewAndRatingModel;
use App\Models\ProductsModel;
use App\Models\ReplacementProductRequestModel;
use App\Models\ReturnProductRequestModel;
use Session;
use Validator;

class ReviewAndRatingController extends Controller
{
     public function __construct(
    						    	ReviewAndRatingModel           $review_and_rating_model,
									ProductsModel                  $products_model,
                                    ReplacementProductRequestModel $replacement_product_requestmodel,
                                    ReturnProductRequestModel      $return_product_request_model
                               )
    {
	    $this->arr_view_data                   = [];
	    $this->module_title                    = "Review and Rating";
	    $this->module_view_folder              = "front.review_and_rating.";
	    $this->BaseModel                       = $review_and_rating_model;
	    $this->ProductsModel                   = $products_model;
        $this->ReplacementProductRequestModel  = $replacement_product_requestmodel;
        $this->ReturnProductRequestModel       = $return_product_request_model;
	    
	    $this->front_url_path                  = url('/');
	    $this->module_url_path                 = $this->front_url_path."/review_and_rating";

	    $this->product_image_base_path       = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_path     = url('/').config('app.project.img_path.product_images');

	    $this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');
    }

    public function index($enc_product_id = false, $enc_order_product_id = false)
    {
    	$product_id = $obj_review_and_rating = $is_product_replace = $is_product_return ='';

        $allog_user_to_review = true;

    	$arr_product = $arr_own_review_and_rating = $arr_review_and_rating = [];

    	$arr_pagination = $arr_gift_cards = $arr_phonecode = [];

    	if($enc_product_id != false)
    	{
    		$product_id = base64_decode($enc_product_id);

    		$obj_product = $this->ProductsModel->where('id',$product_id)
    										   ->with('category','sub_category','brand','product_images')
    										   ->with(['review_and_rating' => function($query){
    										   		$query->select('product_id');
                                                    $query->groupBy('product_id');
                                            		$query->selectRaw('sum(rating) as total_rating');
                                            		$query->selectRaw('count(id) as total_given_rating');
    										   }])
    										   ->first();

    		if($obj_product)
    		{
    			$arr_product = $obj_product->toArray();
    		}

    		if(validate_login('user') == true)
    		{
    			$login_user_id = login_user_id('user');
    			if($enc_order_product_id != false)
    			{
    				$order_product_id = base64_decode($enc_order_product_id);

    				$obj_own_review_and_rating = $this->BaseModel->where([
							    										 'user_id' => $login_user_id,
							    										 'product_id' =>$product_id,
							    										 'order_product_id' =>$order_product_id
							    										])
  																 ->with('user_details')
    															 ->first();
    				if($obj_own_review_and_rating)
    				{
    					$arr_own_review_and_rating = $obj_own_review_and_rating->toArray();
    				}

                    $is_product_replace = $this->ReplacementProductRequestModel->where([
                                                                    'user_id' => $login_user_id,
                                                                    'product_id' =>$product_id,
                                                                    'order_product_id' =>$order_product_id,
                                                                    'status' => '4'
                                                                ])->count();
                    if($is_product_replace > 0)
                    {
                        $allog_user_to_review = false;
                    }
                    else
                    {
                        $is_product_return = $this->ReturnProductRequestModel->where([
                                                                    'user_id' => $login_user_id,
                                                                    'product_id' =>$product_id,
                                                                    'order_product_id' =>$order_product_id,
                                                                    'status' => '4'
                                                                ])->count();
                                                                
                        if($is_product_return > 0)
                        {
                            $allog_user_to_review = false;
                        } 
                    }

                    

    			}
    		}

    		$obj_review_and_rating = $this->BaseModel->orderBy('created_at','DESC')
                                                     ->where('product_id',$product_id)
                                                     ->with('user_details');
			if(validate_login('user') == true && isset($order_product_id) && !empty($order_product_id))
			{
				$login_user_id = login_user_id('user');

				$obj_review_and_rating = $obj_review_and_rating->where('user_id','<>',$login_user_id);
			}

			$obj_review_and_rating = $obj_review_and_rating->paginate(10);

			if($obj_review_and_rating)
			{
				$arr_pagination        = clone $obj_review_and_rating; 
				$arr_review_and_rating = $obj_review_and_rating->toArray();
			}    												 

    	}
    	
        $this->arr_view_data['product_image_base_path']          = $this->product_image_base_path;
        $this->arr_view_data['product_image_public_path']        = $this->product_image_public_path;
        $this->arr_view_data['user_profile_image_base_path']     = $this->user_profile_image_base_path;
        $this->arr_view_data['user_profile_image_public_path']   = $this->user_profile_image_public_path;
        $this->arr_view_data['arr_review_and_rating']            = $arr_review_and_rating;
        $this->arr_view_data['arr_own_review_and_rating']        = $arr_own_review_and_rating;
        $this->arr_view_data['enc_product_id']                   = isset($enc_product_id) ? $enc_product_id : '';
        $this->arr_view_data['enc_order_product_id']             = isset($enc_order_product_id) ? $enc_order_product_id : '';
        $this->arr_view_data['arr_product']                      = $arr_product;
        $this->arr_view_data['module_url_path']                  = $this->module_url_path;
        $this->arr_view_data['page_title']                       = $this->module_title;
        $this->arr_view_data['module_title']                     = $this->module_title;
        $this->arr_view_data['arr_pagination']                   = $arr_pagination;
        $this->arr_view_data['allog_user_to_review']             = isset($allog_user_to_review) ? $allog_user_to_review : '';
        
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function store(Request $request)
    {
    	$arr_rules      = $arr_occassion = array();

		$arr_rules['rating']     =  "required";
		$arr_rules['comment']  =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if(validate_login('user') == false)
		{
			Session::flash('error', 'Please login to your account to add '.$this->module_title.'.');
			return redirect()->back();
		}

		$login_user_id = login_user_id('user');

		$arr_data['order_product_id'] = isset($request->enc_order_product_id) ? base64_decode($request->input('enc_order_product_id')) : ''; 
		$arr_data['product_id'] = isset($request->enc_product_id) ? base64_decode($request->input('enc_product_id')) : ''; 
		$arr_data['user_id'] = isset($login_user_id) ? $login_user_id : ''; 
		$arr_data['review'] = $request->input('comment',false); 
		$arr_data['rating'] = $request->input('rating',false); 


		$status = $this->BaseModel->create($arr_data);
    	
    	if($status)
    	{
			Session::flash('success', $this->module_title.' added successfully.');
    	}
    	else
    	{
    		Session::flash('error', 'Something went to wrong ! Please try again later.');
    	}

    	return redirect()->back();
    }

}
