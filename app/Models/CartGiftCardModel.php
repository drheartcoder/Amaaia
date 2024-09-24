<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartGiftCardModel extends Model
{
	protected $table = 'cart_gift_cards';
	
	protected $fillable = 
	[
	'cart_id',
	'user_id',
	'user_gift_card_id',
	'gift_card_code',
	'amount'
	];
}
