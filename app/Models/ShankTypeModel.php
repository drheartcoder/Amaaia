<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShankTypeModel extends Model
{
    protected $table = 'shank_types';
	protected $fillable = 
	[
	'shank_type',
	'slug',
	'status'
	];
}
