<?php

namespace App\Policies;

use App\Models\MenuCategory;
use App\Models\ShopUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
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

    public function yourshop(User $user,MenuCategory $menuCategory)
    {
        $shop_id=ShopUser::where('user_id',$user->id)->get();

        $all=[];

        foreach ($shop_id as $shop){

            $all[]=$shop->shop_id;
        }

        return in_array($menuCategory->shop_id,$all);
    }
}
