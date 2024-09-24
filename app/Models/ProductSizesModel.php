<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSizesModel extends Model
{
    protected $table = 'product_sizes';
    protected $fillable = [
    						'product_id',
    						'size_name'
    					  ];
}
