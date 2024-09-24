<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplacementProductRequestModel extends Model
{
   protected $table = "replacement_product_request"; 
   protected $fillable = [
   					'user_id',
   					'product_id',
   					'order_id',
                  'order_product_id',
                  'user_wallet_id',
   					'usd_value',
   					'reason',
   					'delivery_method',
   					'mobile_number',
                  'comment',
   					'status'
   			   ];

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
