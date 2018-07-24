@extends('Mdefault')
@section('css')
    <style>
        body{
            height: 100vh;
            margin: 0;
        }
        body{background: url(/15.jpg) no-repeat;background-size:cover;font-size: 16px;}
        .form{background: rgba(255,255,255,0.2);width:400px;margin:100px auto;}
        #login_form{display: block;}
        #register_form{display: none;}
        .fa{display: inline-block;top: 27px;left: 6px;position: relative;color: #ccc;}
        input[type="text"],input[type="password"]{padding-left:26px;}
        .checkbox{padding-left:21px;}
    </style>
@endsection
@section('content')
    @include('default._errors')
    {{--<form class="form-horizontal" action="{{route('shop.login')}}" method="post">--}}
        {{--<div class="form-group">--}}
            {{--<label for="inputUserName3" class="col-sm-2 control-label">账号</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="text" class="form-control" id="inputUserName3" placeholder="账号" name="name" value="{{old('name')}}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--{{ csrf_field() }}--}}

        {{--<div class="form-group">--}}
            {{--<label for="inputUserName3" class="col-sm-2 control-label">密码</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="password" class="form-control" id="inputUserName3" placeholder="密码" name="password" value="">--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label for="inputUserName3" class="col-sm-2 control-label"></label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="checkbox" id="inputUserName3" name="remberme" value="1">记住我--}}
            {{--</div>--}}
        {{--</div>--}}



        {{--<div class="form-group">--}}
            {{--<label for="inputPassword1" class="col-sm-2 control-label">验证码</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<div><img src="{{captcha_src('flat')}}"  onclick="this.src='/captcha/flat?'+Math.random()" alt=""></div>--}}
                {{--<input   class="form-control" type="text" name="captcha">--}}
            {{--</div>--}}
        {{--</div>--}}



        {{--<div class="form-group">--}}
            {{--<div class="col-sm-offset-2 col-sm-10">--}}
                {{--<button type="submit" class="btn btn-primary btn-block">登录</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}

    <div class="form row">
        <form class="form-horizontal col-xs-offset-3" id="login_form" action="{{route('shop.login')}}" method="post">
            <h3 class="form-title">商家登录</h3>
            <div class="col-xs-9">
                <div class="form-group" style="position: relative">
                    <i class="fa fa-user fa-lg"></i>
                    <span class="glyphicon glyphicon-user" style="position: absolute;top:31px;left:5px;"></span>
                    <input class="form-control required" type="text" placeholder="请输入账号" name="name" autofocus="autofocus" maxlength="20" value="{{old('name')}}"/>
                </div>
                <div class="form-group" style="position: relative">
                    <i class="fa fa-lock fa-lg"></i>
                    <span class="glyphicon glyphicon-lock" style="position: absolute;top:31px;left:5px;"></span>
                    <input class="form-control required" type="password" placeholder="请输入密码" name="password" maxlength="8"/>
                </div>

                {{csrf_field()}}
                <div class="form-group" style="position: relative">
                    <i class="fa fa-lock fa-lg"></i>

                    <span class="glyphicon glyphicon-list-alt" style="position: absolute;top:31px;left:5px;"></span>
                    <input class="form-control required" type="text" placeholder="请输入验证码" name="captcha" maxlength="8"/>

                </div>


                <div class="form-group">
                    <i class="fa fa-lock fa-lg"></i>

                    <img src="{{captcha_src('flat')}}"  onclick="this.src='/captcha/flat?'+Math.random()" alt="">

                </div>

                <div class="form-group">
                    <label class="checkbox">
                        <input type="checkbox" name="remberme" value="1"/>记住登录状态
                    </label>
                    <hr />
                    <a href="javascript:;" id="register_btn" class="">立即注册</a>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="登录"/>
                </div>
            </div>
        </form>
    </div>

    <div class="form row">
        <form class="form-horizontal col-sm-offset-3 col-md-offset-3" id="register_form">
            <h3 class="form-title">商家注册</h3>
            <div class="col-xs-9">
                <div class="form-group">
                    <i class="fa fa-user fa-lg"></i>
                    <input class="form-control required" type="text" placeholder="Username" name="username" autofocus="autofocus"/>
                </div>
                <div class="form-group">
                    <i class="fa fa-lock fa-lg"></i>
                    <input class="form-control required" type="password" placeholder="Password" id="register_password" name="password"/>
                </div>
                <div class="form-group">
                    <i class="fa fa-check fa-lg"></i>
                    <input class="form-control required" type="password" placeholder="Re-type Your Password" name="rpassword"/>
                </div>
                <div class="form-group">
                    <i class="fa fa-envelope fa-lg"></i>
                    <input class="form-control eamil" type="text" placeholder="Email" name="email"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="注册"/>
                    <input type="submit" class="btn btn-info pull-left" id="back_btn" value="返回"/>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('js')

    <script>
        $(function() {
            $("#register_btn").click(function() {
                $("#register_form").css("display", "block");
                $("#login_form").css("display", "none");
            });
            $("#back_btn").click(function() {
                $("#register_form").css("display", "none");
                $("#login_form").css("display", "block");
            });
        });
    </script>

@endsection