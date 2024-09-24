<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProductModel extends Model
{
	protected $table = "cart_product";
	protected $fillable = [
	'cart_id',
	'product_id',
	'product_size_id',
	'product_metal_id',
	'product_gemstone_id',
	'product_insurance_id',
	'product_quantity',
	'name_on_product'
	];

	public function product_details()
	{
		return $this->hasOne('App\Models\ProductsModel','id','product_id');
	}

	public function insurance_details()
	{
		return $this->hasOne('App\Models\InsuranceDetailsModel','id','product_insurance_id');
	}

	public function size_details()
	{
		return $this->hasOne('App\Models\ProductSizesModel','id','product_size_id');
	}

	public function product_image()
    {
         return $this->hasOne('App\Models\ProductImagesModel','product_id','product_id');   
    }

    public function cart()
	{
		return $this->hasOne('App\Models\ShoppingCartModel','id','cart_id');
	}

	public function product_metals()
    {
        return $this->hasOne('App\Models\ProductMetalsModel','id','product_metal_id');
    }

    public function product_gemstone()
    {
        return $this->hasOne('App\Models\ProductGemStoneModel','id','product_gemstone_id');
    }
}

