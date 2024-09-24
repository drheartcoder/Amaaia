<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionModel extends Model
{
    protected $table	= 'collections';
	protected $fillable = [
							'name',
							'description',
							'slug',
							'image',
							'status'
						  ];
}
