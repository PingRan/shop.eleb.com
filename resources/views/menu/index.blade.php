@extends('default')
@section('content')

    <a class="btn btn-info" href="{{route('menus.create')}}">添加菜品</a>
    <div>
        @foreach($menucategories as $menucategory)
            <a class="btn btn-default" href="{{route('menus.index',['category_id'=>$menucategory->id,'shop_id'=>$menucategory->shop_id])}}">{{$menucategory->name}}</a>
        @endforeach
    </div>

    <form class="navbar-form" method="get" action="{{route('menus.index')}}">

        <div class="form-group">
            <input type="text" class="form-control" name="goods_name" placeholder="菜名" value="">
        </div>

        <div class="form-group">
            <input type="number" class="form-control" name="min_price" placeholder="起始价格">-
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="max_price" placeholder="结束价格">
        </div>
        <input type="hidden" name="shop_id" value="{{$menucategory->shop_id}}">
        <input type="hidden" name="category_id" value="{{isset($where['category_id'])?$where['category_id']:''}}">
        <button type="submit" class="btn btn-default">搜索</button>
    </form>

    <table class="table table-striped table-hover">
        <tr class="success">
            <th>菜品id</th>
            <th>菜品名字</th>
            <th>菜品分类</th>
            <th>菜品价格</th>
            <th>菜品评分</th>
            <th>月销量</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->category->name}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->rating}}分</td>
                <td>{{$menu->month_sales}}份</td>
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

    {{$menus->appends($where)->links()}}
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