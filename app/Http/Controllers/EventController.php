<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\PrizeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class EventController extends Controller
{
    //活动列表
    public function index()
    {
        $events=Event::all();
        return view('event.index',compact('events'));
    }

    public function eventShow(Event $id)
    {
        $event=$id;
        return view('event.show',compact('event'));
    }
    //报名
    public function SignUp(Event $event)
    {
        $user=Auth::user();
        if($user->eventUser){
            session()->flash('danger','您已报名,请勿重复报名');
            return redirect()->route('events.index');
        };
        //活动id  判断活动人数是否已经满了

        $events_id=$event->id;
        $eventInfo=Event::find($events_id);
        if($eventInfo->signup_num==0){
            session()->flash('danger','活动人数已满,请关注下次活动');
            return redirect()->route('events.index');
        };
        //报名时间，如果没有到 不能报名
        $signup_start=$eventInfo->signup_start;
        $signup_end=$eventInfo->signup_end;
        $time=time();
        if($time<$signup_start||$time>$signup_end){
            session()->flash('danger','请在活动报名时间内来报名');
            return redirect()->route('events.index');
        }

       DB::beginTransaction();

        try{

            EventUser::create(['user_id'=>$user->id,'events_id'=>$events_id]);
            //报名成功减少一个活动报名人数名额
            $signup=$event->signup_num;
            $event->update(['signup_num'=>$signup-1]);
            DB::commit();
        }catch (Exception $e){

            DB::rollBack();
            dd($e);
            session()->flash('danger','报名失败');

        }
        return redirect()->route('events.index');
    }
    //查看抽奖结果
    public function prizeResult(Event $event)
    {
        $prizeusers=PrizeUser::where('events_id',$event->id)->get();

        return view('event.prize',compact('event','prizeusers'));
    }
}
