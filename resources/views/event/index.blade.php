@extends('default')
@section('content')
    <table class="table table-striped table-hover">
        <tr class="success">
            <th>活动id</th>
            <th>活动标题</th>
            <th>活动报名开始时间</th>
            <th>活动报名结束时间</th>
            <th>活动开奖日期</th>
            <th>查看详情</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{date('Y-m-d',$event->signup_start)}}</td>
                <td>{{date('Y-m-d',$event->signup_end)}}</td>
                <td>{{$event->prize_date}}</td>
                <td>
                    <a class="test" href="{{route('eventShow',['id'=>$event->id])}}"><span
                                class="glyphicon glyphicon-zoom-in"></span></a>

                    <a class="btn bg-info" href="{{route('prizeResult',['event'=>$event])}}">查看抽奖结果</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection