@extends('default')
@section('content')
    <h1>{{$activity->title}}</h1>
    <h3>活动时间:{{date('Y-m-d',$activity->start_time)}}--------{{date('Y-m-d',$activity->end_time)}}</h3>
    {!! $activity->content !!}
@endsection
