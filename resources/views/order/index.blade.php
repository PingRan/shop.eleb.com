@extends('default')
@section('content')
    @include('default._errors')

    <table class="table table-striped table-hover">
        <tr class="success">
            <th>订单id</th>
            <th>订单编号</th>
            <th>收货人</th>
            <th>收货人电话</th>
            <th>收货人详细地址</th>
            <th>状态</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->sn}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
                <td>
                    <a class="test" href="{{route('showOrder',['order'=>$order])}}"><span
                                class="glyphicon glyphicon-zoom-in"></span></a>
                    @if($order->status!='已取消')
                    <a class="btn bg-info" href="{{route('cancelOrder',['order'=>$order])}}">取消订单</a>
                    @else
                        <a class="btn bg-info" href="{{route('Ship',['order'=>$order,'code'=>2])}}">发货</a>
                   @endif
                </td>
            </tr>
        @endforeach
        <a class="btn bg-info" href="{{route('orderCount',['shop_id'=>$order->shop_id])}}">订单统计</a>
    </table>
    {{$orders->links()}}
@endsection