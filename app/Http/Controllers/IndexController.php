<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Shop;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function home()
    {

        $now=time();
        $activities=Activity::where('end_time','>',$now)->get();

        $shops=Shop::where('status',0)->orderBy('created_at','desc')->offset(0)->limit(5)->get();

        return view('index.home',compact('activities','shops'));

    }
}
