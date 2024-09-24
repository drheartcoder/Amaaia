<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOtpModel extends Model
{
	protected $table = "user_otp";

	protected $fillable = [
	'user_id',
	'otp',
	'expired_on'
	];
}
