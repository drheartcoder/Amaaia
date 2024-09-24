<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValuationModel extends Model
{
    protected $table = "valuation"; 
    protected $fillable = [
    					   'user_id',
    					   'appointment_date',
    					   'appointment_time',
    					   'mobile_number',
    					   'product_description',
    					   'product_image'
        			      ];

    public function user_details()
    {
    	return $this->belongsTo('App\Models\UserModel','user_id','id');
    }
}
