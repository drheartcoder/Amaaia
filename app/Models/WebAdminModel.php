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

class WebAdminModel extends Model  implements AuthenticatableContract,
                                           AuthorizableContract,
                                           CanResetPasswordContract
{
    protected $hidden = array('password', 'remember_token');
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    protected $table = 'web_admin';
    protected $fillable = ['user_name','first_name','last_name','email','password','password_reset_code','contact','address','remember_token','profile_image'];  
}
