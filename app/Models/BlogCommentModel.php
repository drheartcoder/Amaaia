<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCommentModel extends Model
{
    protected $table	= 'blog_comment';
    
	protected $fillable = [
							'blog_id',
							'user_id',
							'title',
							'comment'
						  ];

	public function user_details()
    {
        return $this->belongsto('App\Models\UserModel','user_id','id');
    }

}
