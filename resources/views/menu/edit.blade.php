@extends('default')
@section('css')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection

@section('web.js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@endsection

@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('menus.update',['menu'=>$menu])}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">菜品名字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUserName3" placeholder="菜品名字" name="goods_name" value="{{$menu->goods_name}}">
            </div>
        </div>

        <div class="form-group">
        <label for="inputUserName3" class="col-sm-2 control-label">菜品分类</label>
        <div class="col-sm-10">
        <select class="form-control" name="category_id">
        <option value="">请选择</option>
        @foreach($menucategories as $menucategory)
        <option  {{$menucategory->id==$menu->category_id?'selected':''}} value="{{$menucategory->id}}">{{$menucategory->name}}</option>
        @endforeach
        </select>
        </div>
        </div>

        
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品图片</label>
            <div class="col-sm-10">
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                    <img id="img" width="150px;" src="{{$menu->goods_img}}" alt="">
                </div>
                <input id="img_url" type="hidden" name="goods_img">
            </div>
        </div>

         {{ csrf_field() }}
         {{method_field('patch')}}
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品价格</label>
            <div class="col-sm-10">
                <input type="number" name="goods_price" value="{{$menu->goods_price}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-10">
                <input type="text" name="tips" value="{{$menu->tips}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="" cols="30" rows="10">{{$menu->description}}</textarea>
            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-10">
                <input type="checkbox" {{$menu->status?'checked':''}} name="status" value="1">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-block">修改</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
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