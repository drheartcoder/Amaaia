<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BandSettingModel extends Model
{
    protected $table = 'band_setting';
	protected $fillable = 
	[
	'band_setting',
	'slug',
	'status'
	];
}
