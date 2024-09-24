<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartModel extends Model
{
    protected $table = "shopping_cart";
    protected $fillable = ['user_id'];

    public function user_details()
	{
		return $this->hasOne('App\Models\UserModel','id','user_id');
	}
}
