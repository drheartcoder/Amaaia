<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLinesModel extends Model
{
	protected $table = "product_lines";
	protected $fillable = [
	'product_type',
	'category_id',
	'sub_category_id',
	'product_line_name',
	'slug',
	'image',
	'status'
	];

	public function sub_category()
	{
		return $this->belongsTo('App\Models\SubCategoryModel','sub_category_id','id');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\CategoryModel','category_id','id');
	}
}
