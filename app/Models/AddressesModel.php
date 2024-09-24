<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressesModel extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
    						'user_id',
    						'flat_no',
    						'building_name',
    						'address',
    						'city',
    						'post_code',
    						'state',
    						'country',
    						'default_address'
                          ];
}
