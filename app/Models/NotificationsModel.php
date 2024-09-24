<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationsModel extends Model
{
   protected $table = "notifications"; 
   protected $fillable = [
   					'receiver_user_id',
   					'receiver_user_type',
   					'notification_message',
   					'notification_url',
   					'is_read',
   					'type'
   			   ];
}
