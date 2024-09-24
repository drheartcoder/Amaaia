<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class UserModel extends Model implements AuthenticatableContract,
                                           AuthorizableContract,
                                           CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $table = "users";
    protected $softDelete = true;
    protected $fillable = [
    						'first_name',
                            'last_name',
    						'gender',
    						'country_phone_code_id',
    						'address',
    						'mobile_number',
    						'email',
    						'password',
                            'remember_token',
    						'password_reset_code',
    						'profile_image',
    						'is_email_verified',
    						'status'
    				      ];

  	 protected $hidden = [
        'password', 'remember_token',
    ];

}
