<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceDetailsModel extends Model
{
	protected $table = 'insurance_details';
	protected $fillable = 
	[
		'company_name',
		'price',
		'description',
		'status'
	];
}


