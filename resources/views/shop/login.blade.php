@extends('default')
@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('shop.login')}}" method="post">
        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">账号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUserName3" placeholder="账号" name="name" value="{{old('name')}}">
            </div>
        </div>
        {{ csrf_field() }}

        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputUserName3" placeholder="密码" name="password" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="checkbox" id="inputUserName3" name="remberme" value="1">记住我
            </div>
        </div>



        <div class="form-group">
            <label for="inputPassword1" class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-10">
                <div><img src="{{captcha_src('flat')}}"  onclick="this.src='/captcha/flat?'+Math.random()" alt=""></div>
                <input  type="text" name="captcha">
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">登录</button>
            </div>
        </div>
    </form>
@endsection