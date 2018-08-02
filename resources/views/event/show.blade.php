@extends('default')
@section('content')
    <h1>{{$event->title}}</h1>
    <h3>活动报名时间:{{date('Y-m-d',$event->signup_start)}}--------{{date('Y-m-d',$event->signup_end)}}</h3>
    <h3>活动开奖时间{{$event->prize_date}}</h3>
    <h3>活动报名人数上限{{$event->signup_num}}</h3>
    {!! $event->content !!}
    奖品池 @foreach($event->prizes as $prize)
            奖品名字:{{$prize->name}}
            数量:{{$prize->num}}
            {!! $prize->description !!}
           @endforeach
    <div>
     @if(!Auth()->user()->eventUser&&$event->signup_num!=0)
    <a href="{{route('signUp',['event'=>$event])}}" class="bg-info btn btn-block">报名</a>
     @endif
    </div>
@endsection
