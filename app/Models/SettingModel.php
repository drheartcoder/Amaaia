<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
	protected $fillable = 
	[
	'setting',
	'slug',
	'status'
	];
}
