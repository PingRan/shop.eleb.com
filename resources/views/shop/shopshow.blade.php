@extends('default')
@section('content')
    <h1>商家详细信息</h1>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <td>店铺名字</td>
            <td>{{$shop->shop_name}}</td>
        </tr>
        <tr>
            <td>店铺图片</td>
            <td><img width="50px;" src="{{$shop->shop_img}}" alt=""></td>
        </tr>

        <tr>
            <td>店铺分类</td>
            <td>{{$shop->shop_category->name}}</td>
        </tr>

        <tr>
            <td>店铺评分</td>
            <td>{{$shop->shop_rating}}</td>
        </tr>

        <tr>
            <td>是否是品牌</td>
            <td>{{$shop->brand?'是':'否'}}</td>
        </tr>

        <tr>
            <td>是否准时送达</td>
            <td>{{$shop->on_time?'是':'否'}}</td>
        </tr>

        <tr>
            <td>是否蜂鸟配送</td>
            <td>{{$shop->fengniao?'是':'否'}}</td>
        </tr>

        <tr>
            <td>是否保标记</td>
            <td>{{$shop->bao?'是':'否'}}</td>
        </tr>

        <tr>
            <td>是否票标记</td>
            <td>{{$shop->piao?'是':'否'}}</td>
        </tr>

        <tr>
            <td>是否准标记</td>
            <td>{{$shop->zhun?'是':'否'}}</td>
        </tr>

        <tr>
            <td>起送金额</td>
            <td>{{$shop->start_send}}￥</td>
        </tr>

        <tr>
            <td>配送费</td>
            <td>{{$shop->send_cost}}￥</td>
        </tr>

        <tr>
            <td>店公告</td>
            <td>{{$shop->notice}}</td>
        </tr>


        <tr>
            <td>优惠信息</td>
            <td>{{$shop->discount}}</td>
        </tr>

        <tr>
            <td>状态:1正常,0待审核,-1禁用</td>
            <td>{{$shop->status?($shop->status==1?'正常':'禁用'):'待审核'}}</td>
        </tr>


    </table>
@endsection