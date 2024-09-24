<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMetalsModel extends Model
{
    protected $table = 'product_metals';
    protected $fillable = [
    						'metal_name_id',
    						'metal_color_id',
    						'metal_quality_id',
    						'product_id'
    					  ];

    public function metal_name()
    {
    	return $this->belongsTo('App\Models\MetalsModel','metal_name_id','id');
    }

    public function metal_color()
    {
        return $this->belongsTo('App\Models\MetalColorModel','metal_color_id','id');
    }

    public function metal_quality()
    {
        return $this->belongsTo('App\Models\MetalQualityModel','metal_quality_id','id');
    }

}
