<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  protected $table = 'vendors';

  protected $primaryKey = 'id';

   protected $fillable = [
       'id_front','id_back','certificate','user_id','category_id','profile_image','title_en','title_ar', 'bio_en','bio_ar','description_en','description_ar'
        ,'address_en','address_ar','area_id','hour_price','state','total_booking','total_reviews','rating','total_wallet','country'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function work_experiences()
   {
       return $this->hasMany('App\WorkExperiences');
   }
}
