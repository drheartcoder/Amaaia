<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = "categories";
    protected $fillable = [
    	'product_type',
    	'category_name',
    	'slug',
        'icon_name',
        'status'
    ];


    public function sub_categories()
    {
        return $this->hasMany("App\Models\SubCategoryModel",'category_id','id');
    }

}
