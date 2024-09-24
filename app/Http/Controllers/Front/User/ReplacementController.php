<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\OrdersProductModel;
use App\Models\ReplacementProductRequestModel;
use App\Common\Services\NotificationService;

use Session;
use Validator;

class ReplacementController extends Controller
{
    function __construct(
    						OrdersProductModel             $ordersproductmodel,
    						ReplacementProductRequestModel $replacement_product_requestmodel,
 							NotificationService            $notification_service
                        )
    {
        $this->module_title                    = "Replacement";
        $this->module_url_path                 = url('/user/replacement');
        $this->module_view_folder              = "front.user.replacement";
        $this->user_panel_slug                 = config('app.project.user_panel_slug');
		
		$this->OrdersProductModel              = $ordersproductmodel;
		$this->BaseModel                       = $replacement_product_requestmodel;
		$this->NotificationService             = $notification_service;
        $this->product_image_base_path         = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_path       = url('/').config('app.project.img_path.product_images');

        $this->bank_receipt_file_base_path     = base_path().config('app.project.img_path.bank_receipt');
        $this->bank_receipt_file_public_path   = url('/').config('app.project.img_path.bank_receipt');
        
    }

    public function index()
    {
        $arr_replacement = $arr_pagination = [];
        
        $id        = login_user_id('user');

      
        $obj_replacement = $this->BaseModel->where('user_id',$id)
                                           ->orderBy('created_at','DESC')
                                           ->with('order_product_details.order')
                                           ->with('order_product_details.product_details.product_images')
                                           ->with('wallet_details')
                                           ->paginate(10);                                       
        
        if($obj_replacement)
        {
            $arr_pagination   = clone $obj_replacement;
            $arr_replacement = $obj_replacement->toArray();
        }

        $this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
        $this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        $this->arr_view_data['arr_replacement']           = $arr_replacement;
        $this->arr_view_data['arr_pagination']      = $arr_pagination;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function replace_product($enc_order_product_id= false)
    {
    	$arr_order = [];

    	if($enc_order_product_id != false)
    	{
    		$order_product_id = base64_decode($enc_order_product_id);

    		$obj_order = $this->OrdersProductModel->where('id',$order_product_id)->select('id','order_id','item_number','product_id','product_name')->first();

    		if($obj_order)
    		{
    			$arr_order = $obj_order->toArray();
    		}
    	}

    	$arr_phonecode                              = get_phonecode();
    	$this->arr_view_data['arr_phonecode']       = $arr_phonecode;
    	$this->arr_view_data['arr_order']           = $arr_order;
        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = 'New '.$this->module_title.' Request';;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Send Request';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function proceed_replacement_request(Request $request)
    {
        $arr_rules      = $arr_data = array();

        $product_id = $product_name = $order_id = '';
        
        $arr_rules['reason']                 =  "required";
        $arr_rules['delivery_method']        =  "required";
        $arr_rules['phonecode']              =  "required";
        $arr_rules['mobile_number']          =  "required|min:7|max:16";
        $arr_rules['comment']                =  "required";
        
        $product_name                        = $request->product_name;

        $validator = validator::make($request->all(),$arr_rules);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $no = $phone_code = $mobile_number = '';

        $no = isset($request->mobile_number) ? $request->mobile_number : '';

        $phone_code = isset($request->phonecode) ? base64_decode($request->phonecode) : ''; 

        $mobile_number = '+'.$phone_code.$no;

        $product_id  = isset($request->product_id) ? $request->product_id : '';

        $order_id = isset($request->order_id) ? $request->order_id : '0';

        $current_dollar_value = get_current_dollar_value();

        $arr_data['user_id']               = login_user_id('user');
        $arr_data['product_id']            = $product_id;
        $arr_data['order_id']              = $order_id;
        $arr_data['usd_value']             = isset($current_dollar_value) ? $current_dollar_value : 0;
        $arr_data['order_product_id']      = isset($request->order_product_id) ? $request->order_product_id : '';
        $arr_data['reason']                = isset($request->reason) ? $request->reason : '';
        $arr_data['delivery_method']       = isset($request->delivery_method) ? $request->delivery_method : '';
        $arr_data['mobile_number']         = isset($mobile_number) ? $mobile_number : '';
        $arr_data['comment']               = isset($request->comment) ? $request->comment : '';
        $arr_data['status']                = '1';
       	
        $status = $this->BaseModel->create($arr_data);

        if($status)
        {
            // Send notification to admin

            $user_first_name = $user_last_name = $user_name ='';

            $sender_details = login_user_details('user');

            $user_first_name = isset($sender_details->first_name) ? $sender_details->first_name : '';
            $user_last_name =  isset($sender_details->last_name) ? $sender_details->last_name : '';

            $user_name = $user_first_name.' '.$user_last_name;


            $arr_noti['user_id']                =  '1';  //receiver user id
            $arr_noti['receiver_user_type_id']  =  '1';
            //$arr_noti['url']                    =  "replacement_products/view/".base64_encode($status->id).'/'.base64_encode($request->order_product_id);
            $arr_noti['url']                    =  "replacement_products";
            $arr_noti['user_name']              =  $user_name;
            $arr_noti['product_name']           =  $product_name;

            $this->NotificationService->store_product_replacement_request_notification($arr_noti);

            Session::flash('success','Product replacement request sent successfully.');
            return redirect($this->module_url_path);
        }
        else
        {
            Session::flash('error','Something went to wrong ! Please try again later.');
            return redirect()->back();
        }

    }

     public function details($enc_order_product_id= false)
    {
        $arr_order =  [];
        if($enc_order_product_id != false)
        {
            $id               = login_user_id('user');
            $order_product_id = base64_decode($enc_order_product_id);

            $obj_order = $this->OrdersProductModel->where('id',$order_product_id)
                                                  ->select('id','order_id','product_id','product_category_name','product_subcategory_name','product_final_price','product_base_price','product_name','product_discount','item_number')
                                                  ->whereHas('order', function($query) use($id){
                                                    $query->where('user_id',$id);
                                                  })

                                                  ->with(['order' => function($query){
                                                        $query->select('id','order_id','address_id','order_flat_no','order_building_name','order_city','order_state','order_country','order_address','order_post_code','order_contact_no','order_usd_value','status','created_at');
                                                  }])
                                                  ->with(['product_details' => function($query){
                                                    $query->select('id','product_description','product_type');
                                                  }])
                                                  ->with('product_details.product_images')
                                                  ->with(['return_request' => function($query){
                                                    $query->select('order_product_id','user_wallet_id','receipt','reason','delivery_method','refund_payment_method','mobile_number','comment','status');
                                                  }])
                                                  ->with(['replacement_request' => function($query){
                                                        $query->select('order_product_id','status');
                                                   }])
                                                  ->with('return_request.wallet_details')
                                                  ->with('replacement_request.wallet_details')
                                                  ->first();

            if($obj_order)
            {
                $arr_order = $obj_order->toArray();
            } 
        }
        else
        {
            Session::flash('error','Problem Occurred, While deleting '.str_singular($this->module_title));
        }

        $this->arr_view_data['bank_receipt_file_base_path']       = $this->bank_receipt_file_base_path;
        $this->arr_view_data['bank_receipt_file_public_path']     = $this->bank_receipt_file_public_path;

        $this->arr_view_data['parent_module_title']       = "Home";
        $this->arr_view_data['page_title']                = 'Order Details';
        $this->arr_view_data['module_title']              = $this->module_title;
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']           = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']         = url('/').'/user/dashboard';
        $this->arr_view_data['arr_order']                 = $arr_order;

        $this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
        $this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

        return view($this->module_view_folder.'.details',$this->arr_view_data);
    }

}
