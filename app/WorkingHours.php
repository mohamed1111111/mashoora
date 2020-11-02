<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
  protected $table = 'working_hours';
  protected $fillable = [
      'vendor_id','day', 'from','to', 'state'
   ];
   public function vendor()
   {
       return $this->belongsTo('App\Vendor');
   }
}
