<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
  protected $table = 'rates';
  protected $fillable = [
    'vendor_id','customer_id','enrollment_id','stars','comment'
   ];
   public function customer()
  {
      return $this->belongsTo('App\Customer');
  }
  public function vendor()
 {
     return $this->belongsTo('App\Vendor');
 }
 public function enrollment()
{
    return $this->belongsTo('App\Enrollment');
}
}
