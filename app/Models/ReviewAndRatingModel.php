<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewAndRatingModel extends Model
{
   protected $table = "review_and_rating"; 
   protected $fillable = [
   					'order_product_id',
   					'product_id',
   					'user_id',
   					'review',
   					'rating'
   			   ];

   	public function user_details()
   	{
   		return $this->belongsTo('App\Models\UserModel','user_id','id');
   	}

      public function products_details()
      {
         return $this->belongsTo('App\Models\ProductsModel','product_id','id');
      }
}
