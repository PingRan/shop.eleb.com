@extends('default')
@section('content')
    <h1>某点的菜品</h1>
    <form action="{{route('menus.index')}}" method="get">
        <select name="category_id" id="">
            <option value="">请选择分类</option>
            @foreach($menucategories as $menucatory)
            <option {{$menucatory->id==$category_id?'selected':''}} value="{{$menucatory->id}}">{{$menucatory->name}}</option>
            @endforeach
        </select>
        <button type="submit">搜索</button>
    </form>
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