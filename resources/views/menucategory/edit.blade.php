@extends('default')
@section('content')
    @include('default._errors')
    <form class="form-horizontal" action="{{route('menucategories.update',['menucategory'=>$menucategory])}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputUserName3" class="col-sm-2 control-label">菜品分类名字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUserName3" placeholder="分类名字" name="name" value="{{$menucategory->name}}">
            </div>
        </div>

        {{--<div class="form-group">--}}
        {{--<label for="inputUserName3" class="col-sm-2 control-label">父级分类</label>--}}
        {{--<div class="col-sm-10">--}}
        {{--<select class="form-control" name="pid">--}}
        {{--<option value="">请选择</option>--}}
        {{--<option value="0">顶级分类</option>--}}
        {{--@foreach($categories as $category)--}}
        {{--<option {{$category->cate_id==old('pid')?'selected':''}} value="{{$category->cate_id}}">{{$category->cate_name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品描述</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="" cols="30" rows="10">{{$menucategory->description}}</textarea>
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label for="inputPassword8" class="col-sm-2 control-label">否是默认分类</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="checkbox" name="is_selected" value="1">--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
        </div>
    </form>
@endsection