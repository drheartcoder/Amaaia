<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalDetailingModel extends Model
{
    protected $table = 'metal_detailings';
	protected $fillable = 
	[
	'metal_detailing_name',
	'slug',
	'status'
	];
}
