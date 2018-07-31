@extends('default')
@section('content')

    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 600px;height:400px;">
        <button class="orderMenu">点击获取菜品排行</button>
    </div>
@endsection
@section('js')
    <script src="/js/echarts.simple.min.js"></script>
    <script type="text/javascript">
//        // 基于准备好的dom，初始化echarts实例
//        var myChart = echarts.init(document.getElementById('main'));
//
//        // 指定图表的配置项和数据
////        option = {
////            xAxis: {
////                type: 'category',
////                data: ['1', '2', '3', '4', '5', '6', '7','8','9','10',11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]
////            },
////            yAxis: {
////                type: 'value'
////            },
////            series: [{
////                data: [100, 200, 300, 150, 122, 155, 133,98,19,66,77, 33, 312, 22, 11, 6, 55,66,15,16,77, 66, 44, 66, 55, 301, 131,101,56,16],
////                type: 'line'
////            }]
////        };

$('#main').on('click','.orderMenu',function() {
    var url = "http://shop.eleb.com/orderMenu";
    alert('s');
    $.get(url,function(e){

        var res=JSON.parse(e);

//                基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        option = {
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : e.data,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'直接访问',
                    type:'bar',
                    barWidth: '30%',
                    data:e.count,
                }
            ]
        };

        myChart.setOption(option);
    });
});

    </script>
@endsection