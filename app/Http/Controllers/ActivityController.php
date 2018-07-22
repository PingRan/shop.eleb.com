<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index()
    {
        //展示平台进行中的活动列表
        $now=time();
        $activities=Activity::where('end_time','>',$now)->get();
        return view('activity.index',compact('activities'));
    }

    public function show(Activity $id)
    {
        //展示平台活动详情
        $activity=$id;
        return view('activity.show',compact('activity'));
    }
}
