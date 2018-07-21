@extends('default')
@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('shop.savepassword')}}" method="post">
        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">账号</label>
            <div class="col-sm-10">
                <input disabled type="text" class="form-control" id="inputUserName3" placeholder="账号" name="name" value="{{$userinfo->name}}">
            </div>
        </div>
        {{ csrf_field() }}


        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputUserName3" placeholder="邮箱" name="email" value="{{$userinfo->email}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">原密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputUserName3" placeholder="原密码" name="oldpassword" value="">
            </div>
        </div>


        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">新密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputUserName3" placeholder="新密码" name="newpassword" value="">
            </div>
        </div>


        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputUserName3" placeholder="确认密码" name="newpassword_confirmation" value="">
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
                <button type="submit" class="btn btn-primary btn-block">修改</button>
            </div>
        </div>
    </form>
@endsection