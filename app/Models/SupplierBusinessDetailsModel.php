<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierBusinessDetailsModel extends Model
{
    protected $table = "supplier_business_details";

    protected $fillable = [
							'supplier_id',
							'business_name',
							'business_reg_no',
							'pan_no',
							'email',
							'country_phone_code_id',
							'mobile_number'
    					  ];
}
