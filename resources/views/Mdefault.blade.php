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


</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @include('default._nav')
        </div>
    </div>

   <div class="row">

       <div class="col-xs-2">
           @yield('left')
       </div>

       <div class="col-xs-9">
           @yield('myinfo')
           @include('default._messages')
           @yield('content')
       </div>

   </div>


    <div class="row">
        <div class="col-xs-12">

        </div>
    </div>


</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->

<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
{{--<script type="text/javascript" src="/js/Particleground.js"></script>--}}
{{--<script type="text/javascript" src="/Js/Treatment.js"></script>--}}

{{--<script>--}}
    {{--$('body').particleground({--}}
        {{--dotColor: '#E8DFE8',--}}
        {{--lineColor: '#8cfabd'--}}
    {{--});--}}
{{--</script>--}}
@yield('js')
</body>
</html>