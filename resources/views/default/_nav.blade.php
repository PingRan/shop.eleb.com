<nav class="navbar navbar-default ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">我要开店<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop.reg')}}">注册店铺信息</a></li>
                        {{--<li><a href="{{route('shops.index')}}">商店列表</a></li>--}}
                    </ul>
                </li>

                @if(Auth()->check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shopshow')}}">我的店铺信息</a></li>
                        {{--<li><a href="{{route('menucategories.create')}}">添加菜品分类</a></li>--}}
                        {{--<li><a href="{{route('menus.create')}}">添加菜品</a></li>--}}
                    </ul>
                </li>
                @endif

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('admins.index')}}">管理员列表</a></li>--}}
                        {{--<li><a href="{{route('admins.create')}}">添加管理员</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家账号<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('users.index')}}">账号列表</a></li>--}}
                        {{--<li><a href="{{route('resetpass')}}">重置商家账号</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            {{--<form class="navbar-form navbar-left" method="get" action="">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="标题或者内容" name="keywords">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">搜索</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">账号:{{ Auth()->user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>

                        <li>
                            <a href="{{route('shop.loginout')}}">注销</a>
                        </li>

                        <li>
                            <a href="{{route('shop.uppassword')}}">修改个人密码</a>
                        </li>
                    </ul>
                </li>
                @endauth



            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>