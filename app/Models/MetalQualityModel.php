<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalQualityModel extends Model
{
    protected $table = 'metal_qualities';
	protected $fillable = 
	[
	'quality_name',
	'slug',
	'status'
	];
}
