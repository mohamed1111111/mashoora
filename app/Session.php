<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
  protected $table = 'sessions';
  protected $fillable = [
    'vendor_id','title','price','date','total_minutes','max_number_of_attendees','bookings_number','vendor_url',
    'attendees_url','recording_url','is_requested_from_customer'
   ];
   protected $casts = [
    'date' => 'datetime:Y-m-d',
      ];
   public function enrollments()
  {
      return $this->hasMany('App\Enrollment');
  }
  public function vendor()
 {
     return $this->belongsTo('App\Vendor');
 }
}
