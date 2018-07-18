<div class="modal fade bs-example-modal-sm" id="login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('login')}}">
                <div>登录</div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="邮箱" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"  placeholder="密码" name="password">
                </div>


                <div class="form-group">
                        <div>验证码</div>
                        <input class="form-control" type="text" name="captcha">
                        <img src="{{captcha_src('falt')}}" alt="" onclick="this.src='/captcha/flat?'+Math.random()" title="点击更换">

                </div>
                {{csrf_field()}}

                <div class="checkbox">
                    <label>
                        <input checked type="checkbox" name="remember_me" value="1">下次自动登录
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">登录</button>
            </form>

        </div>
    </div>

</div>