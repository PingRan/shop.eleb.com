<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Title</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    @yield('css')
    <script src="/js/jquery-3.2.1.js"></script>
    <script src="/js/bootstrap.js"></script>
    @yield('web.js')
    <style>
        body{
            height: 100vh;
            margin: 0;
        }
        body{background:url("/121.jpg") no-repeat;font-size: 16px;}
    </style>
</head>
<body>

<div class="container" style="position: absolute;top:0;margin-left: 350px;">
    <div  class="row">
        <div class="col-xs-12">
            @include('default._nav')
            @include('default._errors')
            @include('default._messages')
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">


            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->


                <div class="carousel-inner" role="listbox">
                    @foreach($activities as $activity)
                    <div class="item active">
                        <a href="{{route('activity.show',['id'=>$activity])}}">
                        <img src="/13.jpg" alt="...">
                        <div class="carousel-caption">
                           {{$activity->title}}
                            <h3>活动时间:{{date('Y-m-d',$activity->start_time)}}--------{{date('Y-m-d',$activity->end_time)}}</h3>
                        </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="item">
                        <img src="/13a.jpg" alt="...">
                        <div class="carousel-caption">

                        </div>
                    </div>
                    ...
                </div>


                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>

    <div class="col-xs-12">
        <table  class="table table-striped table-hover">
            <tr>
                <th>序号</th>
                <th>商铺名字</th>
                <th>申请时间</th>
                <th>申请类型</th>
            </tr>
            @foreach($shops as $shop)
                <tr>
                    <td>{{$shop->id}}</td>
                    <td>{{str_limit($shop->shop_name,5)}}</td>
                    <td>{{$shop->created_at}}</td>
                    <td>{{$shop->shop_category->name}}</td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->

<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script type="text/javascript" src="/js/Particleground.js"></script>
<script type="text/javascript" src="/Js/Treatment.js"></script>

<script>
$('body').particleground({
dotColor: '#E8DFE8',
lineColor: '#faebf9'
});
</script>

</body>
</html>