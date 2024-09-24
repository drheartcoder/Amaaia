<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderWalletModel extends Model
{
    protected $table = 'order_wallet';
    protected $fillable = [

    'order_id',
    'user_id',
    'wallet_id',
    'total_wallet_balance',
    'used_wallet_balance',
    'remaining_wallet_balance'

    ];
}
