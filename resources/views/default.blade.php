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
    <div class="row">
        <div class="col-xs-12">
            @include('default._nav')
        </div>
    </div>

   <div class="row">

       <div class="col-xs-12">
           @include('default._messages')
           @yield('content')
       </div>
   </div>

    <div class="row">
        <div class="col-xs-6">
            @yield('DayOrder')
        </div>
        <div class="col-xs-6">
            @yield('MonthOrder')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            @yield('DayMenu')
        </div>
        <div class="col-xs-6">
            @yield('MonthMenu')
        </div>
    </div>



</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->

{{--<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->--}}
<script type="text/javascript" src="/js/Particleground.js"></script>
<script type="text/javascript" src="/Js/Treatment.js"></script>

{{--<script>--}}
    {{--$('body').particleground({--}}
        {{--dotColor: '#E8DFE8',--}}
        {{--lineColor: '#faebf9'--}}
    {{--});--}}
{{--</script>--}}
@yield('js')
</body>
</html>