<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GemstoneColorModel extends Model
{
    protected $table = 'gemstone_colors';
	protected $fillable = 
	[
	'gemstone_color',
	'slug',
	'status'
	];
}
