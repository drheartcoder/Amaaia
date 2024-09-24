<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCollectionsModel extends Model
{
    protected $table    = "product_collections";
    protected $fillable = [
    						'product_id',
    						'collection_id'
     					  ];

    public function collection()
    {
    	return $this->belongsTo('App\Models\CollectionModel','collection_id','id');
    }

}
