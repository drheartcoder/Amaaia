<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetailsModel extends Model
{
    protected $table = "bank_details";

    protected $fillable = [
							'user_id',
							'user_type',
							'account_holder_name',
							'bank_name',
							'branch',
							'account_number',
							'ifsc_code'
    					  ];

/*	public function supplier_personal_details()
	{
		return $this->belongsTo('App\Models\SupplierModel','supplier_id','id');
	}    					  */
}
