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
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
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
        //对应活动报名的商家
        $eventUser=$user->eventUser->where('events_id',$event->id)->first();

        if($eventUser){
            session()->flash('danger','您已报名,请勿重复报名');
            return redirect()->route('events.index');
        };
        //活动id  判断活动人数是否已经满了
        $eventNumber=EventUser::where('events_id',$event->id)->count();

        if($eventNumber>=$event->signup_num){
            session()->flash('danger','活动人数已满,请关注下次活动');
            return redirect()->route('events.index');
        };
        //报名时间，如果没有到 不能报名
        $signup_start=$event->signup_start;
        $signup_end=$event->signup_end;
        $time=time();
        if($time<$signup_start||$time>$signup_end){
            session()->flash('danger','请在活动报名时间内来报名');
            return redirect()->route('events.index');
        }

        EventUser::create(['user_id'=>$user->id,'events_id'=>$event->id]);

        session()->flash('success','报名成功');

        return redirect()->route('events.index');
    }
    //查看抽奖结果
    public function prizeResult(Event $event)
    {
        if(!$event->is_prize){
            session()->flash('danger','开奖日期为'.$event->prize_date.'请等待');
            return redirect()->route('events.index');
        }

        $prizeusers=PrizeUser::where('events_id',$event->id)->get();

        return view('event.prize',compact('event','prizeusers'));
    }
}
