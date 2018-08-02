<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=['signup_num'];
    //活动的奖品
    public function prizes()
    {
        return $this->hasMany(EventPrize::class,'events_id','id');
    }
}
