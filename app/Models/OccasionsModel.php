<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccasionsModel extends Model
{
   protected $table = "occasions"; 
   protected $fillable = [
   					'occasion_name',
   					'slug',
   					'status'
   			   ];
}
