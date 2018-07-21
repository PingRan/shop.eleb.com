@extends('default')
@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('shop.update',['shop'=>$shop])}}" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">商家名字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUserName3" placeholder="商家名字" name="shop_name" value="{{$shop->shop_name}}">
            </div>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputPassword7" class="col-sm-2 control-label">logo</label>
            <div class="col-sm-10">
                <img width="100px;" src="{{$shop->shop_img}}" alt="">
                <input type="file" name="shop_img">
            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword5" class="col-sm-2 control-label">商家分类</label>
            <div class="col-sm-10">

                <select class="form-control" name="shop_category_id">
                    <option value="0">请选择</option>
                    @foreach($categories as $category)
                        <option  {{$category->id==$shop->shop_category_id?'selected':''}}  value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

            </div>

        </div>


        <div class="form-group">
            <label for="inputPassword4" class="col-sm-2 control-label">是否支持</label>
            <div class="col-sm-10">
                <input type="checkbox" {{$shop->brand?'checked':''}}   name="brand" value="1">品牌
                <input type="checkbox" {{$shop->on_time?'checked':''}}  name="on_time" value="1">准时送达
                <input type="checkbox" {{$shop->fengniao?'checked':''}}  name="fengniao" value="1">蜂鸟配送
                <input type="checkbox" {{$shop->bao?'checked':''}}  name="bao" value="1">保标记
                <input type="checkbox" {{$shop->piao?'checked':''}}  name="piao" value="1">票标记
                <input type="checkbox" {{$shop->zhun?'checked':''}}  name="zhun" value="1">准标记
            </div>
        </div>



        <div class="form-group">
            <label for="inputPassword4" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-10">
                <input type="number" name="start_send" value="{{$shop->start_send}}" >
            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword4" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-10">
                <input type="number" name="send_cost" value="{{$shop->send_cost}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword4" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="notice" id="inputPassword3">{{$shop->notice}}</textarea>

            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="discount" id="inputPassword3">{{$shop->discount}}</textarea>
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
        $("#add").click(function(){
            var info=$("#info").css('display');

            if(info=='none'){
                $("#info").css('display','block')
            }else{
                $("#info").css('display','none')
            }
        });
    </script>
@endsection

