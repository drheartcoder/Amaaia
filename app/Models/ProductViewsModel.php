<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductViewsModel extends Model
{
    protected $table = 'product_views';
    protected $fillable = ['product_id', 'ip'];

    public function product_details()
    {
    	return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }
}
