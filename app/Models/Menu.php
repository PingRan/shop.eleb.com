<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
   protected $fillable=['goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'];

    public function category()
    {
        return $this->hasOne(MenuCategory::class,'id','category_id');
    }


    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
