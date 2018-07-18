<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">用户注册</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputUserName123" class="col-sm-2 control-label">昵称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUserName123" placeholder="昵称" name="name" value="{{old('name')}}">
                        </div>
                    </div>

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="inputUserName300" class="col-sm-2 control-label">头像</label>
                        <div class="col-sm-10">
                            <input type="file"  id="inputUserName300" placeholder="头像" name="img">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputemail" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputemail" placeholder="邮箱" value="{{old('email')}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-10">
                            <input type="password"  name=password class="form-control" id="inputPassword3" placeholder="密码">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputrepassword" class="col-sm-2 control-label">重复密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control" id="inputrepassword" placeholder="再次输入密码">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputPassword6" class="col-sm-2 control-label">请输入验证码</label>
                        <div class="col-sm-10">
                            <input type="text" name="captcha">
                            <img src="{{captcha_src('falt')}}" alt="" onclick="this.src='/captcha/flat?'+Math.random()" title="点击更换">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">注册</button>
                        </div>
                    </div>
                </form>



            </div>
            @include('default._footer')

        </div>
    </div>
</div>