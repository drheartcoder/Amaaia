<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
     protected $table	= 'blogs';
	protected $fillable = [
							'blog_category_id',
							'title',
							'description',
							'blog_image',
							'no_of_views',
							'status',
							'slug'
						  ];

	public function blog_category()
	{
		return $this->belongsTo('App\Models\BlogCategoriesModel','blog_category_id','id');
	}

	public function comment_details()
	{
		return $this->hasMany('App\Models\BlogCommentModel','blog_id','id');
	}
}
