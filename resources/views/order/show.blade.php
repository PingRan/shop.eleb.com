@extends('default')
@section('content')
<h3>订单信息</h3>
<table class="table table-striped table-hover">
    <tr class="success">
        <th>订单id</th>
        <th>订单编号</th>
        <th>收货人</th>
        <th>收货人电话</th>
        <th>收货人详细地址</th>
        <th>订单总价</th>
        <th>订单状态</th>
        <th>订单生成时间</th>
    </tr>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->sn}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->total}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->created_at}}</td>
        </tr>
</table>
<h3>商品信息</h3>
<table class="table table-striped table-hover">
    <tr class="success">
        <th>商品id</th>
        <th>商品名字</th>
        <th>商品价格</th>
        <th>商品数量</th>
        <th>商品图片</th>
    </tr>
    @foreach($orderGoods as $good)
        <tr>
            <td>{{$good->id}}</td>
            <td>{{$good->goods_name}}</td>
            <td>{{$good->goods_price}}</td>
            <td>{{$good->amount}}</td>
            <td><img width="100px;" src="{{$good->goods_img}}" alt=""></td>
        </tr>
    @endforeach
</table>
@if($order->status=='待确认')
    <a class="btn btn-info btn-block" href="{{route('Ship',['order'=>$order,'code'=>-1])}}">取消发货</a>
@else
    <a class="btn btn-info btn-block" href="{{route('Ship',['order'=>$order,'code'=>2])}}">发货</a>
@endif
@endsection
