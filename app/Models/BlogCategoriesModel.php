<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoriesModel extends Model
{
	protected $table = "blog_categories";
	protected $fillable = [
	'product_type',
	'category_name',
	'slug',
	'status'
	];

	public function blogs()
	{
		return $this->hasMany('App\Models\BlogModel','blog_category_id','id');
	}


}
