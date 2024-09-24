<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    protected $table = "subcategories";

    protected $fillable = [
							'product_type',
							'category_id',
							'subcategory_name',
							'slug',
                            'market_orientation_markup',
                            'description',
                            'image',
							'status'
    					  ];

    public function get_category()
    {
    	return $this->belongsTo("App\Models\CategoryModel",'category_id','id');
    }

    public function product_line()
    {
        return $this->hasMany("App\Models\ProductLinesModel",'sub_category_id','id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\ProductsModel','id','subcategory_id');
    }
}
