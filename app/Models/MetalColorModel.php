<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalColorModel extends Model
{
    protected $table = 'metal_colors';
	protected $fillable = 
	[
	'metal_color',
	'slug',
	'status'
	];
}
