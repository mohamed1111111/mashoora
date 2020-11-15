<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notification\PasswordResetNotification;
use Spatie\Permission\Traits\HasRoles;



class User extends  Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','country_code','phone_number','type','device_token','gender','apple_token','google_token',
        'snapchat_token','is_verfied','language','state','confirm_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
    public function vendor()
    {
        return $this->hasOne('App\Vendor');
    }
    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

}
