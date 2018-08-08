<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ActivityController extends Controller
{
    // 活动列表页和活动详情页,页面静态化
    public function index()
    {

        //先判断redis中活动表示是否存在 存在表示活动更新了,重新缓存

        $mark=Redis::get('article');
        if(!$mark){

            if(is_file('activity_List.html')){
                return redirect('activity_List.html');
            }

            }

        //展示平台进行中的活动列表
        $now=time();
        $activities=Activity::where('end_time','>',$now)->get();
        $article_Index=view('activity.index',compact('activities'));
        file_put_contents('activity_List.html',$article_Index);
        return redirect('activity_List.html');
    }

    public function show(Activity $id)
    {
        //展示平台活动详情

        $activity=$id;

        $mark=Redis::get('article');
        if(!$mark){

            if(is_file('activity'.$activity->id.'_Show.html')){
                return redirect('activity'.$activity->id.'_Show.html');
            }
        }
        
          $article_Content=view('activity.show',compact('activity'));
         file_put_contents('activity'.$activity->id.'_Show.html',$article_Content);
         return redirect('activity_Show.html');
    }
}
