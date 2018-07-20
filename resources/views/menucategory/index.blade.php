@extends('default')
@section('content')
    <h1>某点的菜品分类</h1>
    <table class="table table-striped table-hover">
        <tr class="success">
            <th>菜品分类id</th>
            <th>菜品分类名字</th>
            <th>菜品商家</th>
            <th>菜品分类的描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menucategories as $menucategory)
            <tr>
                <td>{{$menucategory->id}}</td>
                <td>{{$menucategory->name}}</td>
                <td>{{$menucategory->shop_id}}</td>
                <td>{{$menucategory->description}}</td>
                <td>{{$menucategory->is_selected?'是':'否'}}
                    @if(!$menucategory->is_selected)
                    <a href="{{route('selected',['menucategory'=>$menucategory])}}">设置为默认菜品分类</a>
                    @endif
                </td>
                <td>

                        <a class="test" href="{{route('menucategories.edit',['menucategory'=>$menucategory->id])}}"><span
                                    class="glyphicon glyphicon-edit"></span></a>

                    <a id="{{$menucategory->id}}" class="delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('js')
    <script>
        $('.table').on('click','.delete',function(){

            var url="menucategories/"+this.id;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:url,
                type:"DELETE",
                dataType:"json",
                success:function(e){


                    if(e['success']){
                        alert('删除成功');
                    }else{
                        alert('该分类下有菜品，不能删除')
                    }

                    location.href="";

                }
            });

        })


    </script>
@endsection