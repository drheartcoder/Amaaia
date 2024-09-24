<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\OrdersModel;
use App\Models\OrdersProductModel;
use App\Models\ReturnProductRequestModel;

use App\Common\Services\NotificationService;

use Session;
use Validator;


class MyOrderController extends Controller
{
	function __construct(
                           OrdersModel               $ordersmodel,
                           OrdersProductModel        $ordersproductmodel,
                           ReturnProductRequestModel $return_product_request_model,
                           NotificationService       $notification_service
                        )
    {
        $this->module_title                  = "My Orders";
        $this->module_url_path               = url('/user/my_orders');
        $this->module_view_folder            = "front.user.my_orders";
        $this->user_panel_slug               = config('app.project.user_panel_slug');

        $this->OrdersModel                   = $ordersmodel;
        $this->OrdersProductModel            = $ordersproductmodel;
        $this->ReturnProductRequestModel     = $return_product_request_model;

        $this->NotificationService           = $notification_service;

        $this->product_image_base_path       = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_path     = url('/').config('app.project.img_path.product_images');

        $this->bank_receipt_file_base_path   = base_path().config('app.project.img_path.bank_receipt');
        $this->bank_receipt_file_public_path = url('/').config('app.project.img_path.bank_receipt');
    }

    /*
    | Author    : Deepak Bari
    | Function  : Displyaing orders listing(Order wise).
    */

    public function index()
    {
        $arr_order = $arr_pagination = [];
        $id = '';
        $id        = login_user_id('user');

        $obj_order = $this->OrdersModel->where('user_id',$id)/*->where('status', '!=' ,'0')*/
        ->with('transaction')
        ->whereHas('transaction', function($q){
            $q->where('payment_status','!=','0');
        })
                                       ->with(['order_products' => function($query){
                                            $query->select('id','order_id');
                                            $query->selectRaw('sum(product_discount) as total_discount_percent');
                                            $query->selectRaw('count(id) as total_products');
                                            $query->groupBy('order_id');
                                       }, 'order_giftcard', 'order_wallet'])
                                       ->with('order_products.product_details.product_images')
                                       ->with('order_giftcard')
                                       ->with('order_wallet')
                                       ->orderBy('id','DESC')
                                       ->paginate(10);

        if($obj_order)
        {
            $arr_pagination   = clone $obj_order;
            $arr_order = $obj_order->toArray();
        }

        $this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
        $this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        $this->arr_view_data['arr_order']           = $arr_order;
        $this->arr_view_data['arr_pagination']      = $arr_pagination;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    /*
    | Author    : Deepak Bari
    | Function  : Displyaing orders listing(product wise).
    */

    public function products($order_id = false)
    {
        $arr_order = $arr_pagination = [];
        
        $id        = login_user_id('user');

        $obj_order = $this->OrdersProductModel
                                       ->select('id','order_id','product_id','product_category_name','product_subcategory_name','product_base_price','product_final_price','product_name','product_discount','product_discount','product_insurance_company','product_insurance','product_quantity','insurance_on_product')
                                       ->whereHas('order', function($query) use($id){
                                        $query->where('user_id',$id);
                                       })
                                       ->with(['order' => function($query) use($order_id){
                                            $query->select('id','order_id','address_id','order_usd_value','status','order_return_date','created_at');
                                            
                                       }])
                                       ->with(['return_request' => function($query){
                                            $query->select('order_product_id','status');
                                       }])
                                       ->with(['replacement_request' => function($query){
                                            $query->select('order_product_id','status');
                                       }])
                                       ->where('order_id',$order_id)
                                       ->with('product_details.product_images')
                                       ->orderBy('created_at','DESC')
                                       ->paginate(10);

        
        if($obj_order)
        {
            $arr_pagination   = clone $obj_order;
            $arr_order = $obj_order->toArray();
        }

        $this->arr_view_data['product_image_base_path']   = $this->product_image_base_path;
        $this->arr_view_data['product_image_public_path'] = $this->product_image_public_path;

        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        $this->arr_view_data['arr_order']           = $arr_order;
        $this->arr_view_data['arr_pagination']      = $arr_pagination;
        return view($this->module_view_folder.'.products',$this->arr_view_data);
    }

    /*
    | Author    : Deepak Bari
    | Function  : Display details of specific order.
    */

    public function details($enc_order_product_id= false)
    {
        $arr_order =  [];
        if($enc_order_product_id != false)
        {
            $id               = login_user_id('user');
            $order_product_id = base64_decode($enc_order_product_id);

            $obj_order = $this->OrdersProductModel->where('id',$order_product_id)
                                                  ->select('id','order_id','product_id','product_category_name','product_subcategory_name','product_final_price','product_base_price','product_name','product_discount','item_number','name_on_product')
                                                  ->whereHas('order', function($query) use($id){
                                                    $query->where('user_id',$id);
                                                  })

                                                  ->with(['order' => function($query){
                                                        $query->select('id','order_id','address_id','order_flat_no','order_building_name','order_city','order_state','order_country','order_address','order_post_code','order_contact_no','order_usd_value','cancellation_reason','status','created_at');
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

    public function return_product($enc_order_product_id= false)
    {
        $arr_order = [];

        if($enc_order_product_id != false)
        {
            $order_product_id = base64_decode($enc_order_product_id);

            $obj_order = $this->OrdersProductModel->where('id',$order_product_id)->select('id','order_id','item_number','product_id','product_name','product_supplier_id')->first();

            if($obj_order)
            {
                $arr_order = $obj_order->toArray();
            }

            $arr_phonecode                              = get_phonecode();

            $this->arr_view_data['arr_phonecode']       = $arr_phonecode;
            $this->arr_view_data['parent_module_title'] = "Return product";
            $this->arr_view_data['page_title']          = $this->module_title;
            $this->arr_view_data['module_title']        = $this->module_title;
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
            $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

            $this->arr_view_data['arr_order']           = $arr_order;
            return view($this->module_view_folder.'.product_return',$this->arr_view_data);
        }
        else
        {
            Session::flash('error','Something went to wrong ! Please try again later.');
            return redirect()->back();
        }

    }

    public function proceed_return_request(Request $request)
    {
        $arr_rules      = $arr_data = $arr_noti_supplier =  array();

        $product_id = $product_name = $order_id = '';
        
        $arr_rules['reason']                 =  "required";
        $arr_rules['delivery_method']        =  "required";
        $arr_rules['refund_payment_method']  =  "required";
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
        $arr_data['refund_payment_method'] = isset($request->refund_payment_method) ? $request->refund_payment_method : '';
        $arr_data['mobile_number']         = isset($mobile_number) ? $mobile_number : '';
        $arr_data['comment']               = isset($request->comment) ? $request->comment : '';
        $arr_data['status']                = '1';
       
        $status = $this->ReturnProductRequestModel->create($arr_data);

        if($status)
        {
            // Send notification to admin

            $user_first_name = $user_last_name = $user_name ='';

            $sender_details = login_user_details('user');

            $user_first_name = isset($sender_details->first_name) ? $sender_details->first_name : '';
            $user_last_name =  isset($sender_details->last_name) ? $sender_details->last_name : '';

            $user_name = $user_first_name.' '.$user_last_name;

            // Notify supplier

            if(isset($request->product_supplier_id) && !empty($request->product_supplier_id))
            {
                $arr_noti['user_id']                =  isset($request->product_supplier_id) ? $request->product_supplier_id : 0;  //receiver user id
                $arr_noti['receiver_user_type_id']  =  '3';
                $arr_noti['url']                    =  "orders/return/view/".base64_encode($status->id).'/'.base64_encode($request->order_product_id);
                $arr_noti['user_name']              =  $user_name;
                $arr_noti['product_name']           =  $product_name;

                $this->NotificationService->store_product_return_request_notification($arr_noti);
            }

            // Notify admin
            $arr_noti_supplier['user_id']                =  '1';  //receiver user id
            $arr_noti_supplier['receiver_user_type_id']  =  '1';
            $arr_noti_supplier['url']                    =  "return_product/view/".base64_encode($status->id).'/'.base64_encode($request->order_product_id);
            $arr_noti_supplier['user_name']              =  $user_name;
            $arr_noti_supplier['product_name']           =  $product_name;

            $this->NotificationService->store_product_return_request_notification($arr_noti_supplier);

            Session::flash('success','Product return request sent successfully.');
            
            return redirect($this->module_url_path.'/'.$order_id);
        }
        else
        {
            Session::flash('error','Something went to wrong ! Please try again later.');
            return redirect()->back();
        }

    }
}
