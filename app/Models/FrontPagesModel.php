<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontPagesModel extends Model
{
    protected $table = "front_pages";
    protected $fillable = [
							'page_title',
							'page_description',
							'slug',
							'meta_keyword',
							'meta_title',
							'meta_description',
							'status'
    					 ];
}
