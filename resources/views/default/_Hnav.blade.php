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
            <a class="navbar-brand" href="#">HomePage</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">文章<span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li><a href="{{route('essays.create')}}">发布文章</a></li>
                    </ul>
                </li>



                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">精品推荐 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">精品文章</a></li>
                        <li><a href="#">最多浏览</a></li>
                        <li><a href="#">超值商品</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">良心推荐</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">PHP入门到直发</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" method="get" action="{{route('home.index')}}">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="标题或者内容" name="keywords">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a  data-toggle="modal" data-target="#myModal" href="#">注册</a></li>
                @guest
                <li><a  data-toggle="modal" data-target="#login" href="#">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth()->user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('users.edit',['user'=>Auth()->user()])}}">修改个人信息</a></li>

                        <li>
                            <form action="{{route('loginOut')}}" method="post">
                                {{csrf_field()}} {{method_field('delete')}}
                                <button class="btn-danger">注销</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>