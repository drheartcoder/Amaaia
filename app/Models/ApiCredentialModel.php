<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCredentialModel extends Model
{
	protected $table = 'api_details';
	protected $fillable = 
	[
	'dimond_api_key', 
	'dimond_api_secret', 
	'ccavenue_api_key', 
	'ccavenue_api_secret', 
	'sms_api_key', 
	'sms_api_secret'
	];
}
	