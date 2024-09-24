<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGiftCardModel extends Model
{
    protected $table = 'order_gift_cards';
    protected $fillable = [

    'order_id',
    'user_id',
    'user_gift_card_id',
    'gift_card_code',
    'amount'
    ];
}
