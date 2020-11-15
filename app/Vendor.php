<?php

namespace App;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;


class Vendor extends Model
{
  protected $table = 'vendors';

  protected $primaryKey = 'id';

   protected $fillable = [
       'id_front','id_back','certificate','user_id','category_id','profile_image','title_en','title_ar', 'bio_en','bio_ar','description_en','description_ar'
        ,'address_en','address_ar','area_id','hour_price','state','total_booking','total_reviews','rating','total_wallet'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function work_experiences()
    {
       return $this->hasMany('App\WorkExperiences');
    }
    public function working_hours()
    {
      return $this->hasMany('App\WorkingHours');
    }
   public function sessions()
    {
     return $this->hasMany('App\Session');
    }
    public function rates()
     {
      return $this->hasMany('App\Rate');
     }
    public function scopeFilter($query, QueryFilter $filters)
    {
      return $filters->apply($query);
    }

}
