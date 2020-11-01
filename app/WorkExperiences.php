<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperiences extends Model
{
  protected $table = 'work_experiences';
  protected $fillable = [
      'vendor_id','position_en', 'position_ar','location_en', 'location_ar','start_date', 'end_date','currently','state'
   ];
   public function vendor()
   {
       return $this->belongsTo('App\Vendor');
   }
}
