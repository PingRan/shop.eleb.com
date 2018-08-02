@extends('default')
@section('content')
    <h1>{{$event->title}}</h1>
    <h3>活动报名时间:{{date('Y-m-d',$event->signup_start)}}--------{{date('Y-m-d',$event->signup_end)}}</h3>
    <h3>活动开奖时间{{$event->prize_date}}</h3>
    <h3>活动报名人数上限{{$event->signup_num}}</h3>
    {!! $event->content !!}
    奖品池 @foreach($event->prizes as $prize)
            奖品名字:{{$prize->name}}  数量:{{$prize->num}}
            {!! $prize->description !!}
           @endforeach
    <div>
        <table class="table table-striped table-hover">
            <tr class="success">
                <th>编号</th>
                <th>中奖账号</th>
                <th>活动</th>
                <th>奖品</th>
            </tr>
            @foreach($prizeusers as $prizeuser)
                <tr>
                    <td>{{$prizeuser->id}}</td>
                    <td>{{$prizeuser->user->name}}</td>
                    <td>{{$prizeuser->prize_name}}</td>
                    <td>{{$event->title}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
