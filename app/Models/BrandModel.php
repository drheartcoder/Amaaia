<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    protected $table = 'product_brands';
	protected $fillable = 
	[
	'brand_name',
	'slug',
	'status'
	];
}
