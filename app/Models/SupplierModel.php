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

class SupplierModel extends Model implements AuthenticatableContract,
                                           AuthorizableContract,
                                           CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, Notifiable;
	protected $table    = 'suppliers';
	protected $softDelete = true;
    protected $fillable   = [   
                                'first_name',
                                'last_name',
                                'country_phone_code_id',
                                'address',
                                'mobile_number',
                                'email',
                                'password',
                                'password_reset_code',
                                'remember_token',
                                'profile_image',
                                'is_email_verified',
                                'is_admin_verified',
                                'status',
                                'admin_commission'
                            ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];	

    public function business_details()
    {
        return $this->belongsTo('App\Models\SupplierBusinessDetailsModel','id','supplier_id');
    }

    public function financial_details()
    {
        return $this->belongsTo('App\Models\BankDetailsModel','id','user_id');
    }


}