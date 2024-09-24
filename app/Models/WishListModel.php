<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishListModel extends Model
{
   protected $table = "wish_list"; 
   protected $fillable = [
   					'user_id',
   					'product_id',
   					'product_type'
   			   ];


   public function product()
   {
   		return $this->belongsTo('App\Models\ProductsModel','product_id','id');
   }
}
