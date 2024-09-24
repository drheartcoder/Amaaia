<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGemStoneModel extends Model
{
    protected $table = 'product_gemstone';
    protected $fillable = [
    						'gemstone_type_id',
    						'gemstone_color_id',
    						'gemstone_quality_id',
    						'gemstone_shape_id',
    						'product_id'
    					  ];

    public function gemstone_type()
    {
    	return $this->belongsTo('App\Models\GemStoneModel','gemstone_type_id','id');
    }

    public function gemstone_color()
    {
        return $this->belongsTo('App\Models\GemstoneColorModel','gemstone_color_id','id');
    }

    public function gemstone_quality()
    {
        return $this->belongsTo('App\Models\GemstoneQualitiesModel','gemstone_quality_id','id');
    }

    public function gemstone_shape()
    {
        return $this->belongsTo('App\Models\GemstoneShapesModel','gemstone_shape_id','id');
    }
}
