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

    </table>
    {{$orders->links()}}
@endsection
@section('DayOrder')
    <h3>本店历史订单数:{{$hisCount}}单</h3>
    <h3 style="margin-top: 25px;">每日订单统计图</h3>
    <div id="Day">
        <form action="" method="get" class="Dform">
            <input id="DayOrder" type="date" name="day">
            <input type="hidden" name="shop_id" value="{{$order->shop_id}}">
            <input type="button" class="orderCount btn bg-info" value="提交">
        </form>
    </div>
    <div id="main" style="width: 600px;height:400px;"></div>
@endsection
@section('MonthOrder')
    <h3>本店历史菜品销量:{{$menusCount[0]->menus}}份</h3>
    <h3>本月订单统计图</h3>
    <span class="month" style="color: red"></span>
    <div id="SMonth">
        <form action="" method="get" class="Mform">
            <input id="MonthOrder" type="month" name="month">
            <input type="hidden" name="shop_id" value="{{$order->shop_id}}">
            <input type="button" class="orderMonth btn bg-info" value="提交">
        </form>
    </div>
    <div id="month" style="width: 600px;height:400px;"></div>
@endsection
@section('DayMenu')
    <h3>每日菜品销量统计图</h3>
    <div id="Dmenu">
        <form action="" method="get" class="Dmform">
            <input id="DayMenu"  type="date" name="Dmenu">
            <input type="hidden" name="shop_id" value="{{$order->shop_id}}">
            <input type="button" class="orderMenu btn bg-info" value="提交">
        </form>
    </div>
    <div id="menu" style="width: 600px;height:400px;"></div>
@endsection
@section('MonthMenu')
    <h3>每月菜品销量统计图</h3>
    <div id="Monthmenu">
        <form action="" method="get" class="Mmform">
            <input  id="Mmenu" type="month" name="MonthMenu">
            <input type="hidden" name="shop_id" value="{{$order->shop_id}}">
            <input type="button" class="MonthMenuOrder btn bg-info" value="提交">
        </form>
    </div>
    <div id="MonthMenu" style="width: 600px;height:400px;"></div>
@endsection

@section('js')
    <script src="/js/echarts.min.js"></script>
    <script type="text/javascript">

        function getDayOrder(){
            var data=$('.Dform').serializeArray();
            var url = "{{route('orderCount')}}";
            $.get(url, data,function (e) {

                var res = JSON.parse(e);
                $("#DayOrder").val(res.time);
//                基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('main'));

                option = {
                    xAxis: {
                        type: 'category',
                        data: res.data
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [{
                        data: res.count,
                        type: 'line'
                    }]
                };

                myChart.setOption(option);
            });
        }
        getDayOrder();

        $('#Day').on('click', '.orderCount', function () {
            getDayOrder();
        });

       function getMonthOrder(){
       var data=$('.Mform').serializeArray();
       var url = "{{route('orderMonth')}}";
        $.get(url,data,function (e) {

        var res = JSON.parse(e);
        $(".month").html('本月订单数' + res.count + '单');
        $("#MonthOrder").val(res.time);
//                基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('month'));

        option = {
            xAxis: {
                type: 'category',
                data: res.data
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: res.count,
                type: 'line'
            }]
        };

        myChart.setOption(option);
    });
}
        getMonthOrder();

        $('#SMonth').on('click', '.orderMonth', function () {

            getMonthOrder();
        });

        function dayMenu(){
            var data=$('.Dmform').serializeArray();
            var url = "{{route('orderMenu')}}";
            $.get(url,data,function (e) {

                var res = JSON.parse(e);
                 $("#DayMenu").val(res.time);
//                基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('menu'));

                option = {
                    color: ['#88ccdb'],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: res.data,
                            axisTick: {
                                alignWithLabel: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value'
                        }
                    ],
                    series: [
                        {
                            name: '菜品销量',
                            type: 'bar',
                            barWidth: '25%',
                            data: res.count,
                        }
                    ]
                };

                myChart.setOption(option);
            });
        }
        dayMenu();
        $('#Dmenu').on('click', '.orderMenu', function () {
            dayMenu();
        });

        function monthMenu(){
            var data=$('.Mmform').serializeArray();
            var url = "{{route('MonthMenuOrder')}}";
            $.get(url,data,function (e) {

                var res = JSON.parse(e);
                $("#Mmenu").val(res.time);
//                基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('MonthMenu'));

                option = {
                    color: ['#88ccdb'],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: res.data,
                            axisTick: {
                                alignWithLabel: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value'
                        }
                    ],
                    series: [
                        {
                            name: '菜品销量',
                            type: 'bar',
                            barWidth: '25%',
                            data: res.count,
                        }
                    ]
                };

                myChart.setOption(option);
            });
        }
        monthMenu();

        $('#Monthmenu').on('click', '.MonthMenuOrder', function () {
            monthMenu();
        });

    </script>
@endsection