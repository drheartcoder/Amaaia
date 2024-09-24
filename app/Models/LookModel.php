<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookModel extends Model
{
   protected $table = "look";
   protected $fillable = [
   							'look',
   							'slug',
   							'status'
   						 ];
}
