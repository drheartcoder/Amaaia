<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalsModel extends Model
{
	protected $table = 'metals';
	protected $fillable = 
	[
	'metal_name',
	'metal_color',
	'metal_quality',
	'slug',
	'status'
	];
}
