<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Admin extends Model
{

  protected $table = 'admin';
  protected $primaryKey = 'id';
  protected $fillable = [
      'user_id','state'
   ];
   public function user()
   {
       return $this->belongsTo('App\User');
   }
}
