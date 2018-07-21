<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //
    protected $fillable=['name','type_accumulation','shop_id','description','is_selected'];

    public function menus()
    {
        return $this->hasMany(Menu::class,'category_id','id');
    }


    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
