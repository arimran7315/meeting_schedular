<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
   public $guarded = [];
   public function user()
   {
       return $this->belongsTo(User::class);
   }
    // Define the relationship to the Meeting model
   // Define the relationship to the Meeting model
   public function meeting()
   {
       return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
   }
}
