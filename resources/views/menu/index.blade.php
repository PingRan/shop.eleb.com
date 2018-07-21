@extends('default')
@section('content')
    {{--<h1>{{$menucategories[0]->shop->shop_name}}菜品列表</h1>--}}

    <form class="navbar-form" method="get" action="{{route('menus.index')}}">

        <div class="form-group">

            <select name="category_id" class="form-control">
                <option value="">请选择分类</option>
                @foreach($menucategories as $menucatory)
                    <option {{$menucatory->id==$category_id?'selected':''}} value="{{$menucatory->id}}">{{$menucatory->name}}</option>
                @endforeach
            </select>
          <input type="hidden" name="shop_id" value="{{$menucatory->shop_id}}">
        </div>

        <div class="form-group">
            <input type="number" class="form-control" name="min_price" placeholder="起始价格">-
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="max_price" placeholder="结束价格">
        </div>



        <button type="submit" class="btn btn-default">搜索</button>
    </form>

    <a class="btn btn-info btn-block" href="{{route('menus.create')}}">添加菜品</a>
    <table class="table table-striped table-hover">
        <tr class="success">
            <th>菜品id</th>
            <th>菜品名字</th>
            <th>菜品分类</th>
            <th>菜品价格</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->category->name}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>
                        <a class="test" href="{{route('menus.edit',['menu'=>$menu->id])}}"><span
                                    class="glyphicon glyphicon-edit"></span></a>

                    <a class="test" href="{{route('menus.show',['menu'=>$menu])}}"><span
                                class="glyphicon glyphicon-zoom-in"></span></a>
                    <a id="{{$menu->id}}" class="delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        @endforeach
    </table>

    {{$menus->appends(['category_id'=>$category_id])->links()}}
@endsection

@section('js')
    <script>
        $('.table').on('click','.delete',function(){

            var url="menus/"+this.id;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:url,
                type:"DELETE",
                dataType:"json",
                error:function(e){

                    location.href="";


                }
            });

        })


    </script>
@endsection