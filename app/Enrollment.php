<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
  protected $table = 'enrollments';
  protected $fillable = [
    'customer_id','session_id','status','rejected_reason','canceled_by'
     ];

   public function session()
     {
         return $this->belongsTo('App\Session');
     }
   public function customer()
    {
         return $this->belongsTo('App\Customer');
    }
  public function rate()
   {
        return $this->hasOne('App\Rate');
   }
}
