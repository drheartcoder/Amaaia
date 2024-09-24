<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiryModel extends Model
{
    protected $table = "contact_enquiry";
    protected $fillable = [
    						'first_name',
    						'last_name',
    						'email',
    						'contact_no',
    						'message',
    						'status',
    						'admin_reply'
    					  ];
}
