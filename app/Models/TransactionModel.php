<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
	protected $table = "transactions";

	protected $fillable = [
	'transaction_id',
	'tracking_id',
	'order_id',
	'user_id',
	'product_id',
	'user_gift_card_id',
	'return_product_request_id',
	'replacement_product_request_id',
	'bank_ref_no',
	'order_status',
	'payment_status',
	'card_name',
	'currency',
	'amount',
	'failure_message',
	'payment_mode',
	'status_code',
	'status_message',
	'billing_name',
	'billing_address',
	'billing_city',
	'billing_state',
	'billing_country',
	'billing_zip',
	'billing_email',
	'billing_tel',
	'delivery_name',
	'delivery_address',
	'delivery_city',
	'delivery_state',
	'delivery_zip',
	'delivery_country',
	'delivery_tel',
	'trans_date',
	'trans_type',
	'response_data',
	'transaction_usd_value'

	];


	public function user_details()
	{
		return $this->belongsTo('App\Models\UserModel','user_id','id');
	} 

	public function order_details()
	{
		return $this->hasOne('App\Models\OrdersModel','order_id','order_id');
	} 
}


