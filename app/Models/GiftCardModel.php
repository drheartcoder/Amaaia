<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCardModel extends Model
{
    protected $table = "gift_cards";
    
    protected $fillable = [
    						'title',
    						'description',
    						'image',
    						'code',
    						'amount',
    						'amount_usd',
    						'status'
    					  ];

}
