<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
       'user_id','total_booking','total_reviews','rating','state','social_states','date_of_birth'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function enrollments()
   {
       return $this->hasMany('App\Enrollment','customer_id');
   }
   public function rates()
  {
      return $this->hasMany('App\Rate');
  }
}
