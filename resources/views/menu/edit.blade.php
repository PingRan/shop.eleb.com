@extends('default')
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
            <label for="inputPassword3" class="col-sm-2 control-label">菜品图片</label>
            <div class="col-sm-10">
                <img width="120px;" src="{{$menu->goods_img}}" alt="">
                <input type="file" name="goods_img">
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
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
        </div>
    </form>
@endsection