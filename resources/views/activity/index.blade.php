@extends('default')
@section('content')
    <table class="table table-striped table-hover">
        <tr class="success">
            <th>活动id</th>
            <th>活动标题</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>查看详情</th>
        </tr>
        @foreach($activities as $activity)
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->title}}</td>
                <td>{{date('Y-m-d',$activity->start_time)}}</td>
                <td>{{date('Y-m-d',$activity->end_time)}}</td>
                <td>
                    <a class="test" href="{{route('activity.show',['id'=>$activity])}}"><span
                                class="glyphicon glyphicon-zoom-in"></span></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection