<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingShoulderModel extends Model
{
   protected $table = "ring_shoulder_type";
   protected  $fillable = [
							'ring_shoulder_type',
							'slug',
							'status'
   						  ];
}
