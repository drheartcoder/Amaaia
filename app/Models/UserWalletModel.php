<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWalletModel extends Model
{
	protected $table = "user_wallet";

	protected $fillable = [
	'user_id',
	'order_id',
	'product_id',
	'amount_debited',
	'amount_credited',
	'transaction_status',
	'type'
	];

	public function user_details()
	{
		return $this->hasOne('App\Models\UserModel','id','user_id');
	}

	public function order_details()
	{
		return $this->hasOne('App\Models\OrdersModel','order_id','order_id');
	}

	public function product_details()
	{
		return $this->hasOne('App\Models\ProductsModel','id','product_id');
	}
}
