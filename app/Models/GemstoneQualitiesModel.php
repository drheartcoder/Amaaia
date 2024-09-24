<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GemstoneQualitiesModel extends Model
{
    protected $table = 'gemstone_qualities';
	protected $fillable = 
	[
	'gemstone_quality',
	'slug',
	'status'
	];
}
