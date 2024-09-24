<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GemstoneShapesModel extends Model
{
    protected $table = 'gemstone_shapes';
	protected $fillable = 
	[
	'shape_name',
	'slug',
	'status'
	];
}
