<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PrizeUser extends Model
{
    //根据商家id获取商家账号
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
