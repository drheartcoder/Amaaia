<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GemStoneModel extends Model
{
   	protected $table    = "gemstone";

   	protected $fillable = [
   							'type',
   							'color',
   							'quality',
   							'shape',
   							'slug',
   							'status'
   					      ];
}
