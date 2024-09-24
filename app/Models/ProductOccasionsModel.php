<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOccasionsModel extends Model
{
    protected $table = 'product_occasions';
    protected $fillable = [
    						'product_id',
    						'occasion_id'
    					  ];

    public function occasion()
    {
    	return $this->belongsTo('App\Models\OccasionsModel','occasion_id','id');
    }
}
