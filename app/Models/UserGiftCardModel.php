<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGiftCardModel extends Model
{
 	protected $table = "user_gift_cards";
	protected $fillable = [
	'from_user_id',
	'gift_card_id',
	'user_to_email',
	'user_to_phone',
	'gift_card_code',
	'amount',
	'is_used'
	];

	public function giftcard_details()
	{
		return $this->belongsTo('App\Models\GiftCardModel','gift_card_id','id');
	}
	
	public function user_details()
	{
		return $this->belongsTo('App\Models\UserModel','from_user_id','id');
	}
}
