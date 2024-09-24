<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnProductRequestModel extends Model
{
   protected $table = "return_product_request"; 
   protected $fillable = [
   					'user_id',
   					'product_id',
   					'order_id',
                  'order_product_id',
                  'user_wallet_id',
                  'usd_value',
   					'receipt',
   					'reason',
   					'delivery_method',
   					'refund_payment_method',
   					'mobile_number',
                  'comment',
   					'status'
   			   ];

   public function order_details()
   {
      return $this->belongsTo('App\Models\OrdersModel','order_id','order_id');
   }

   public function order_product_details()
   {
      return $this->belongsTo('App\Models\OrdersProductModel','order_product_id','id');
   }

   public function customer_details()
   {
      return $this->belongsTo('App\Models\UserModel','user_id','id');  
   }

   public function wallet_details()
   {
       return $this->belongsTo('App\Models\UserWalletModel','user_wallet_id','id');    
   }
}
