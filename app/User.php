<?php

namespace App;

use App\Models\EventUser;
use App\Models\Shop;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
    protected $fillable=['name','email','password','status','rememberToken','shop_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shops()
    {
        return $this->hasMany(Shop::class,'id','shop_id');
    }
    //关联报名表
    public function eventUser()
    {
        return $this->hasMany(EventUser::class,'user_id','id');
    }
}
