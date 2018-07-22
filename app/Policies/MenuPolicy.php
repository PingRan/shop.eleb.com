<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\ShopUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function yourmenu(User $user,Menu $menu)
    {

        $shop_id=ShopUser::where('user_id',$user->id)->get();

        $all=[];

        foreach ($shop_id as $shop){

            $all[]=$shop->shop_id;
        }

        return in_array($menu->shop_id,$all);
    }
}
