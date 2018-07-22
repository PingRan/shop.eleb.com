@extends('default')
@section('css')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection

@section('web.js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@endsection

@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('saveshop',['id'=>$user_id])}}" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="inputUserName3" class="col-sm-2 control-label">商家名字</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputUserName3" placeholder="商家名字" name="shop_name" value="{{old('shop_name')}}">
                </div>
            </div>
            {{ csrf_field() }}

        <div class="form-group">
            <label for="inputPassword7" class="col-sm-2 control-label">logo</label>
            <div class="col-sm-10">

                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                    <img id="img" src="" alt="">
                </div>
                <input id="img_url" type="hidden" name="shop_img">

            </div>
        </div>


            <div class="form-group">
                <label for="inputPassword5" class="col-sm-2 control-label">商家分类</label>
                <div class="col-sm-10">

                    <select class="form-control" name="shop_category_id">
                        <option value="0">请选择</option>
                        @foreach($categories as $category)
                            <option  {{$category->id==old('shop_category_id')?'selected':''}}  value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">是否支持</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="brand" value="1">品牌
                    <input type="checkbox" name="on_time" value="1">准时送达
                    <input type="checkbox" name="fengniao" value="1">蜂鸟配送
                    <input type="checkbox" name="bao" value="1">保标记
                    <input type="checkbox" name="piao" value="1">票标记
                    <input type="checkbox" name="zhun" value="1">准标记
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">起送金额</label>
                <div class="col-sm-10">
                    <input type="number" name="start_send" value="{{old('start_send')}}" >
                </div>
            </div>


            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">配送费</label>
                <div class="col-sm-10">
                    <input type="number" name="send_cost" value="{{old('send_cost')}}">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">店公告</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="notice" id="inputPassword3">{{old('notice')}}</textarea>

                </div>
            </div>


            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">优惠信息</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="discount" id="inputPassword3">{{old('discount')}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword7" class="col-sm-2 control-label">添加账号</label>
                <div class="col-sm-10">
                    <input  id="add" type="checkbox" name="adduser" value="1">
                </div>
            </div>


        <div id="info" style="display: none">

            <div class="form-group">
                <label for="inputPassword7" class="col-sm-2 control-label">账号</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword7" class="col-sm-2 control-label">email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="{{old('email')}}">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword7" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="password">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword7" class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
            </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block">发布</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $("#add").click(function(){
            var info=$("#info").css('display');

            if(info=='none'){
                $("#info").css('display','block')
            }else{
                $("#info").css('display','none')
            }
        });

        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '{{route('uploader')}}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}',
            }

        });

        uploader.on( 'uploadSuccess', function(file,responese) {

            var url=responese.fileurl;
            $("#img").attr('src',url);
            $("#img_url").val(url);
        });

    </script>



@endsection
