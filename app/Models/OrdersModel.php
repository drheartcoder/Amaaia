<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';

    protected $fillable = [

    'order_id',
    'user_id',
    'address_id',
    'order_fname',
    'order_lname',
    'order_email',
    'order_contact_no',
    'order_flat_no',
    'order_building_name',
    'order_city',
    'order_state',
    'order_country',
    'order_address',
    'order_post_code',
    'order_payment_method',
    'order_cost',
    'order_gst',
    'status',
    'comment',
    'order_usd_value',
    'order_return_date',
    'order_subtotal',
    'cancellation_reason'
    ];


    public function address()
    {
        return $this->belongsTo('App\Models\AddressesModel','address_id','id');
    }                          

    public function order_products()
    {
        return $this->hasMany('App\Models\OrdersProductModel','order_id','order_id');
    }

    public function order_giftcard()
    {
        return $this->hasOne('App\Models\OrderGiftCardModel','order_id','order_id');
    }

    public function order_wallet()
    {
        return $this->hasOne('App\Models\OrderWalletModel','order_id','order_id');
    }

    public function users_details()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }
    public function bank_details()
    {
     return $this->hasOne('App\Models\BankDetailsModel','user_id','user_id');   
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\TransactionModel','order_id','order_id');
    }

        

}
