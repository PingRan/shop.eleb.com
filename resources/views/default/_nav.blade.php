<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">我要开店<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop.reg')}}">注册店铺信息</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">查看eleb活动<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('activity.index')}}">eleb活动</a></li>
                    </ul>
                </li>

                @if(Auth()->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">店铺<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('shopshow')}}">我的店铺信息</a></li>
                            <li><a href="{{route('addshop',['id'=>Auth()->id()])}}">开分店</a></li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">抽奖活动<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('events.index')}}">抽奖活动</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">账号:{{ Auth()->user()->name }}<span class="caret"></span></a>
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