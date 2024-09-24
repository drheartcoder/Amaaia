<?php

namespace App\Common\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\NotificationTemplateModel;
use App\Models\NotificationsModel;
use App\Models\OrdersProductModel;
use App\Models\OrdersModel;
use App\Common\Services\SmsService;

use App\Models\UserModel;
use Session;

class NotificationService 
{
  function __construct(SmsService $sms_service)
  {
   $this->arr_view_data   = [];
   $this->module_url_path = url('/').'/api';
   $this->SmsService      = $sms_service;
 }

 public function store_user_registration_notification($arr_noti)
 {
   $arr_notification_template = $this->get_notification_template(5);

   $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

   $content      = str_replace("##NAME##",$arr_noti['name'],$content);
   $content      = str_replace("##USER_TYPE##",$arr_noti['user_type'],$content);

   $arr_ins['receiver_user_id']        = isset($arr_noti['user_id']) ? $arr_noti['user_id'] : ''; 
   $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
   $arr_ins['notification_message']    = isset($content) ? $content : '';
   $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
   $arr_ins['is_read']                 = '0';

   $status = NotificationsModel::create($arr_ins);
   return $status;
 }

 public function store_new_product_add_notification($arr_noti)
 {
   $arr_notification_template = $this->get_notification_template(2);

   $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

   $content      = str_replace("##SUPPLIER_NAME##",$arr_noti['supplier_name'],$content);
   $content      = str_replace("##PRODUCT_TYPE##",$arr_noti['product_type'],$content);
   $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

   $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
   $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
   $arr_ins['notification_message']    = isset($content) ? $content : '';
   $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
   $arr_ins['is_read']                 = '0';

   $status = NotificationsModel::create($arr_ins);
   return $status;
 }

 public function store_set_website_commission_notification($arr_noti)
 {
   $arr_notification_template = $this->get_notification_template(6);

   $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

   $content      = str_replace("##ADMIN_NAME##",$arr_noti['admin_name'],$content);
   $content      = str_replace("##PERCENT##",$arr_noti['commission'],$content);

   $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
   $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
   $arr_ins['notification_message']    = isset($content) ? $content : '';
   $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
   $arr_ins['is_read']                 = '0';

   $status = NotificationsModel::create($arr_ins);
   return $status;
 }

 public function store_product_verifiaction_approval_notification($arr_noti) 
 {
  $arr_notification_template = $this->get_notification_template(1);
  $content                   = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
  $content                   = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

  $arr_ins['receiver_user_id']     = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : '';
  $arr_ins['receiver_user_type']   = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : '';
  $arr_ins['notification_message'] = isset($content) ? $content : '';
  $arr_ins['is_read']              = '0';
  $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';

  $status = NotificationsModel::create($arr_ins);
  return $status;
}

public function store_product_verifiaction_rejection_notification($arr_noti) 
{
  $arr_notification_template       = $this->get_notification_template(4);
  $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
  $content                         = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

  $arr_ins['receiver_user_id']     = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : '';
  $arr_ins['receiver_user_type']   = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : '';
  $arr_ins['notification_message'] = isset($content) ? $content : '';
  $arr_ins['is_read']              = '0';
  $arr_ins['notification_url']     = isset($arr_noti['url']) ? $arr_noti['url'] : '';
  
  $status = NotificationsModel::create($arr_ins);
  return $status;
}

public function new_order_notification($arr_data=null)
{
  $status = false;

  if($arr_data!=null)
  {
    $obj_order = OrdersModel::select(['id'])->where('order_id', $arr_data['order_id'])->first();
    //Send notification to user itself

    $arr_ins = [];

    $arr_notification_template       = $this->get_notification_template(9);
    $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
    $content                         = str_replace("##ORDER_ID##",$arr_data['order_id'],$content);
    $arr_ins['receiver_user_id']     = isset($arr_data['user_id']) ? $arr_data['user_id'] : '';
    $arr_ins['notification_message'] = isset($content) ? $content : '';
    $arr_ins['receiver_user_type']   = '2';
    $arr_ins['is_read']              = '0';
    $arr_ins['type']                 = '2';
    $arr_ins['notification_url']     = 'my_orders/'.base64_encode($obj_order->id);
    $status                          = NotificationsModel::create($arr_ins);
    $status                          = $this->SmsService->send_sms(strip_tags($content), $arr_data['order_mobile']);
    //Send notification to admin
    
    $arr_ins = [];

    $arr_notification_template       = $this->get_notification_template(10);
    $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
    $content                         = str_replace("##ORDER_ID##",$arr_data['order_id'],$content);
    $arr_ins['receiver_user_id']     = '1';
    $arr_ins['notification_message'] = isset($content) ? $content : '';
    $arr_ins['receiver_user_type']   = '1';
    $arr_ins['type']                 = '2';
    $arr_ins['is_read']              = '0';
    $arr_ins['notification_url']     = 'orders/new/view/'.base64_encode($obj_order->id);

    $status = NotificationsModel::create($arr_ins);

    //send notification to supplier

    $obj_supplier_id = OrdersProductModel::where('order_id', $arr_data['order_id'])->select('product_supplier_id')->get();

    if($obj_supplier_id)
    {

      $arr_ins = [];
      $arr_supplier_id                 = $obj_supplier_id->toArray();
      $arr_notification_template       = $this->get_notification_template(11);
      $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
      $content                         = str_replace("##ORDER_ID##",$arr_data['order_id'],$content);
      $arr_ins['notification_message'] = isset($content) ? $content  : '';
      $arr_ins['receiver_user_type']   = '3';
      $arr_ins['is_read']              = '0';
      $arr_ins['type']              = '1';
      $arr_ins['notification_url']     = 'orders/new/view/'.base64_encode($obj_order->id);

      foreach ($arr_supplier_id as $key => $supplier_id) 
      {
        $arr_ins['receiver_user_id'] = $supplier_id['product_supplier_id'];
        $status                      = NotificationsModel::create($arr_ins);
      }
    }
  } 

  return $status;
}
public function store_product_return_request_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(8);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##USER_NAME##",$arr_noti['user_name'],$content);
 $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['user_id']) ? $arr_noti['user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';

 $status = NotificationsModel::create($arr_ins);
 return $status;
}

public function get_notification_template($noti_template_id)
{
  $arr_template_data = [];

  $obj_notification_template = NotificationTemplateModel::where('id',$noti_template_id)->first();

  if($obj_notification_template)
  {
    $arr_template_data = $obj_notification_template->toArray();
  }
  return $arr_template_data;                        
}

public function store_product_return_request_acceptance_rejection_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(12);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##ADMIN_NAME##",$arr_noti['admin_name'],$content);
 $content      = str_replace("##STATUS##",$arr_noti['status'],$content);
 $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';
 $arr_ins['type']                    = isset($arr_noti['notification_type']) ? $arr_noti['notification_type'] : '';

 NotificationsModel::create($arr_ins);
 return $content;
}


public function store_return_product_payment_release_notification($arr_noti)
{
 if(isset($arr_noti['refund_payment_method']) && $arr_noti['refund_payment_method'] == '1')
 {
  $arr_notification_template = $this->get_notification_template(13);
}
elseif(isset($arr_noti['refund_payment_method']) && $arr_noti['refund_payment_method'] == '2')
{
  $arr_notification_template = $this->get_notification_template(14);
}

$content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

if(isset($arr_noti['amount']) && !empty($arr_noti['amount']))
{
  $content      = str_replace("##AMOUNT##",$arr_noti['amount'],$content);
}

$content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);



$arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
$arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
$arr_ins['notification_message']    = isset($content) ? $content : '';
$arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
$arr_ins['is_read']                 = '0';
$arr_ins['type']                    = '3';

NotificationsModel::create($arr_ins);
return $content;
}

public function store_product_return_rejection_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(15);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##ADMIN_NAME##",$arr_noti['admin_name'],$content);
 $content      = str_replace("##STATUS##",$arr_noti['status'],$content);
 $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';
 $arr_ins['type']                    = isset($arr_noti['notification_type']) ? $arr_noti['notification_type'] : '';

 NotificationsModel::create($arr_ins);
 return $content;
}


public function order_status_notification($arr_data=null)
{
  $status = false;

  if($arr_data!=null)
  {
    //Send notification to user
    $arr_ins                         = [];

    $arr_notification_template       = $this->get_notification_template(16);
    $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
    $content                         = str_replace("##ORDER_ID##",$arr_data['order_id'],$content);
    $content                         = str_replace("##STATUS##",$arr_data['status'],$content);
    $arr_ins['receiver_user_id']     = isset($arr_data['user_id']) ? $arr_data['user_id'] : '';
    $arr_ins['notification_message'] = isset($content) ? $content : '';
    $arr_ins['receiver_user_type']   = '2';
    $arr_ins['is_read']              = '0';
    $arr_ins['type']              = isset($arr_data['type'])? $arr_data['type']:'';
    $arr_ins['notification_url']     = 'my_orders/'.$arr_data['order_id'];

    //Send sms to user
    $status                          = NotificationsModel::create($arr_ins);
    $status                          = $this->SmsService->send_sms($arr_ins['notification_message'], $arr_data['mobile_no']);


    //Send notification to admin
    $arr_ins                         = [];
    $arr_notification_template       = $this->get_notification_template(17);
    $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
    $content                         = str_replace("##ORDER_ID##",$arr_data['order_id'],$content);
    $content                         = str_replace("##STATUS##",$arr_data['status'],$content);
    $arr_ins['receiver_user_id']     = '1';
    $arr_ins['notification_message'] = isset($content) ? $content : '';
    $arr_ins['receiver_user_type']   = '1';
    $arr_ins['is_read']              = '0';
    $arr_ins['type']              = isset($arr_data['type'])? $arr_data['type']:'';
    $arr_ins['notification_url']     = '/orders/view/'.$arr_data['order_id'];

    $status                          = NotificationsModel::create($arr_ins);


    //send notification to supplier
    $obj_supplier_id                 = OrdersProductModel::where('order_id', $arr_data['order_id'])
    ->select('product_supplier_id')
    ->get();
    if($obj_supplier_id)
    {
      $arr_ins                         = [];
      $arr_supplier_id                 = $obj_supplier_id->toArray();
      $arr_notification_template       = $this->get_notification_template(18);
      $content                         = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';
      $content                         = str_replace("##ORDER_ID##",$arr_data['order_id'],$content);
      $content                         = str_replace("##STATUS##",$arr_data['status'],$content);
      $arr_ins['notification_message'] = isset($content) ? $content : '';
      $arr_ins['receiver_user_type']   = '3';
      $arr_ins['is_read']              = '0';
      $arr_ins['type']              = isset($arr_data['type'])? $arr_data['type']:'';
      $arr_ins['notification_url']     = '/orders/view/'.$arr_data['order_id'];

      foreach ($arr_supplier_id as $key => $supplier_id)
      {
        $arr_ins['receiver_user_id']    = $supplier_id['product_supplier_id'];
        $status                         = NotificationsModel::create($arr_ins);
      }
    }
    return $status;
  }


}

/*
| Name - Deepak Bari
| Function - Store valuation request notification.
| Date - 06-06-2018.
*/

public function store_valuation_request_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(19);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##USER_NAME##",$arr_noti['user_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['user_id']) ? $arr_noti['user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';

 $status = NotificationsModel::create($arr_ins);
 return $status;
}

public function store_product_replacement_request_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(20);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##USER_NAME##",$arr_noti['user_name'],$content);
 $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['user_id']) ? $arr_noti['user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';

 $status = NotificationsModel::create($arr_ins);
 return $status;
}

public function store_product_replacement_request_acceptance_rejection_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(21);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##ADMIN_NAME##",$arr_noti['admin_name'],$content);
 $content      = str_replace("##STATUS##",$arr_noti['status'],$content);
 $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';
 $arr_ins['type']                    = isset($arr_noti['notification_type']) ? $arr_noti['notification_type'] : '';

 NotificationsModel::create($arr_ins);
 return $content;
}


public function store_replacement_product_payment_release_notification($arr_noti)
{
  $arr_notification_template = $this->get_notification_template(22);

  $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

  if(isset($arr_noti['amount']) && !empty($arr_noti['amount']))
  {
    $content      = str_replace("##AMOUNT##",$arr_noti['amount'],$content);
  }

  $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

  $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
  $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
  $arr_ins['notification_message']    = isset($content) ? $content : '';
  $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
  $arr_ins['is_read']                 = '0';
  $arr_ins['type']                    = '3';

  NotificationsModel::create($arr_ins);
  return $content;
}

public function store_product_replacement_rejection_notification($arr_noti)
{
 $arr_notification_template = $this->get_notification_template(23);

 $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

 $content      = str_replace("##ADMIN_NAME##",$arr_noti['admin_name'],$content);
 $content      = str_replace("##STATUS##",$arr_noti['status'],$content);
 $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);

 $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
 $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
 $arr_ins['notification_message']    = isset($content) ? $content : '';
 $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
 $arr_ins['is_read']                 = '0';
 $arr_ins['type']                    = isset($arr_noti['notification_type']) ? $arr_noti['notification_type'] : '';

 NotificationsModel::create($arr_ins);
 return $content;
}

public function store_return_product_supplier_notification($arr_noti)
{
    $arr_notification_template = $this->get_notification_template(24);

    $content      = isset($arr_notification_template['template_html'])?$arr_notification_template['template_html']:'';

    $content      = str_replace("##PRODUCT_NAME##",$arr_noti['product_name'],$content);



    $arr_ins['receiver_user_id']        = isset($arr_noti['receiver_user_id']) ? $arr_noti['receiver_user_id'] : ''; 
    $arr_ins['receiver_user_type']      = isset($arr_noti['receiver_user_type_id']) ? $arr_noti['receiver_user_type_id'] : ''; 
    $arr_ins['notification_message']    = isset($content) ? $content : '';
    $arr_ins['notification_url']        = isset($arr_noti['url']) ? $arr_noti['url'] : '';
    $arr_ins['is_read']                 = '0';
    $arr_ins['type']                    = '3';

    NotificationsModel::create($arr_ins);
    return $content;
}


}
