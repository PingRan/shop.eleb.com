@extends('default')
@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('menus.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">菜品名字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUserName3" placeholder="菜品名字" name="goods_name" value="{{old('goods_name')}}">
            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品图片</label>
            <div class="col-sm-10">
                <input type="file" name="goods_img">
            </div>
        </div>


        <div class="form-group">
        <label for="inputUserName3" class="col-sm-2 control-label">菜品分类</label>
        <div class="col-sm-10">
        <select class="form-control" name="category_id">
        <option value="">请选择</option>
        @foreach($menucategories as $menucategory)
        <option  value="{{$menucategory->id}}">{{$menucategory->name}}</option>
        @endforeach
        </select>
        </div>
        </div>

        {{ csrf_field() }}

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品价格</label>
            <div class="col-sm-10">
                <input type="number" name="goods_price">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-10">
                <input type="text" name="tips">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">添加</button>
            </div>
        </div>
    </form>
@endsection