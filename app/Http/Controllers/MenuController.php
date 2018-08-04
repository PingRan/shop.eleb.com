<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except '=>[]
        ]);
    }
    public function index(Request $request)
    {
        $shop_id=$request->shop_id;

        $shop=Shop::find($shop_id);
        //根据当前登录用户的id获取出该账号下的所有店铺id；
        $shops=ShopUser::where('user_id',Auth::id())->get(['shop_id'])->toArray();
        //快速将二维数组转化成一维数组，主要利用数组合并
        $result=[];
        //调用回调函数array_map 将二维数组中的每一个一唯数组传入 然后获取对应的值。在合并到空数组中。
        array_map(function($value)use(&$result){
           $result=array_merge($result,array_values($value));
        },$shops);

       if(!in_array($shop_id,$result)){
           return redirect()->route('shopshow');
       };

        $shop_status=$shop->status;

        if($shop_status!=1){
            session()->flash('danger','该店还未通过审核，请耐心等待');
            return redirect()->route('shopshow');
        }

        session(['shop_id'=>$shop_id]);

        $menucategories=MenuCategory::where('shop_id',$shop_id)->get();

        $condition=[];//存储搜索条件.

        $condition[]=['shop_id',$shop_id];

        $where['shop_id']=$shop_id;

        $category_id=$request->category_id;

       if($category_id){
           $condition[]=['category_id',$category_id];
           $where['category_id']=$category_id;
       }

        if($request->goods_name){
            $condition[]=['goods_name','like',"%{$request->goods_name}%"];
            $where['goods_name']=$request->goods_name;
        }

        if($request->max_price){
            $condition[]=['goods_price','<=',$request->max_price];
            $where['max_price']=$request->max_price;
        }

        if($request->min_price){
            $condition[]=['goods_price','>=',$request->min_price];
            $where['min_price']=$request->min_price;
        }

        $menus=Menu::where($condition)->paginate(6);

       return view('menu.index',compact('menus','menucategories','where'));
    }

    public function create()
    {
        $shop_id=session('shop_id');

        $menucategories=MenuCategory::where('shop_id',$shop_id)->get();

        return view('menu.create',compact('menucategories'));

    }

    public function store(Request $request)
    {
       $this->validate($request,
           [
               'goods_name'=>'required|max:20|unique:menus',
               'category_id'=>'required',
               'goods_price'=>'required|numeric',
               'description'=>'required|max:150',
               'tips'=>'required|max:50',
               'goods_img'=>['required'],
           ],
           [
             'goods_name.required'=>'菜品名字不能为空',
              'goods_name.max'=>'菜品名字在20个字以内',
               'goods_name.unique'=>'菜品名字已存在',
              'category_id.required'=>'菜品分类不能为空',
               'goods_price.required'=>'菜品的价格不能为空',
               'goods_price.numeric'=>'菜品的价格必须为数字',
               'description.required'=>'菜品简介不能为空',
               'description.max'=>'菜品简介在150个字以内',
               'tips.required'=>'菜品提示不能为空',
               'tips.max'=>'菜品提示在50个字以内',
               'goods_img.required'=>'请上传菜品图片',
           ]
       );

        if($request->goods_img){

            $request['goods_img']=$request->goods_img;

       }else{

           $request['goods_img']='http://elebran.oss-cn-shenzhen.aliyuncs.com/elebran/upload/2p36m7e7woK8YwknXkS5H039WIVPUmUhckeKSkdT.jpeg';
       }

       $request['shop_id']=session('shop_id');

        //随机生成月销量，
        $request['month_sales']=mt_rand(500,2000);

        //随机生成评分数量，
        $request['rating_count']=mt_rand(500,2000);

        //随机生成满意度评分

        $request['satisfy_rate']=mt_rand(1,100);;
        //随机生成菜品评分
        $request['rating']=mt_rand(1,9).'.'.mt_rand(0,9);
        //随机生成满意度数量
        $request['satisfy_count']=mt_rand(10,1000);

        Menu::create($request->input());

       session()->flash('success','菜品添加成功');

       return redirect()->route('menus.index',['shop_id'=>session('shop_id')]);
    }

    public function edit(Menu $menu)
    {
        $this->authorize('yourmenu',$menu);
        $shop_id=session('shop_id');

        $menucategories=MenuCategory::where('shop_id',$shop_id)->get();

      return view('menu.edit',compact('menu','menucategories'));
    }

    public function update(Request $request,Menu $menu)
    {
        $this->validate($request,
            [
                'goods_name'=>['required','max:20',Rule::unique('menus')->ignore($menu->id)],
                'category_id'=>'required',
                'goods_price'=>'required|numeric',
                'description'=>'required|max:150',
                'tips'=>'required|max:50',
            ],
            [
                'goods_name.required'=>'菜品名字不能为空',
                'goods_name.max'=>'菜品名字在20个字以内',
                'goods_name.unique'=>'菜品名字已存在',
                'category_id.required'=>'菜品分类不能为空',
                'goods_price.required'=>'菜品的价格不能为空',
                'goods_price.numeric'=>'菜品的价格必须为数字',
                'description.required'=>'菜品简介不能为空',
                'description.max'=>'菜品简介在150个字以内',
                'tips.required'=>'菜品提示不能为空',
                'tips.max'=>'菜品提示在50个字以内',
                'goods_img.required'=>'请上传菜品图片',
            ]
        );

        $status=$request->status??0;
        $data=['goods_name'=>$request->goods_name,'category_id'=>$request->category_id,'goods_price'=>$request->goods_price,'tips'=>$request->tips,'description'=>$request->description,'status'=>$status];

        //随机生成月销量，
        $data['month_sales']=mt_rand(500,2000);

        //随机生成评分数量，
        $data['rating_count']=mt_rand(500,2000);


        //随机生成满意度评分
        $data['satisfy_rate']=mt_rand(1,100);
        //随机生成菜品评分
        $data['rating']=mt_rand(1,9).'.'.mt_rand(0,9);
        //随机生成满意度数量
        $data['satisfy_count']=mt_rand(500,2000);
        if($request->goods_img) {
            $data['goods_img'] =$request->goods_img;
        }
        $menu->update($data);

        session()->flash('success', '菜品修改成功');

        return redirect()->route('menus.index', ['shop_id' => session('shop_id')]);

    }

    public function destroy(Menu $menu)
    {
        $this->authorize('yourmenu',$menu);
       $menu->delete();

       echo '删除成功';
    }

    public function show(Menu $menu)
    {
        $this->authorize('yourmenu',$menu);
        return view('menu.show',compact('menu'));
    }
    //修改菜品的状态
    public function updateStatus(Menu $menu)
    {

        $status=$menu->status?0:1;

        $menu->update(['status'=>$status]);

        session()->flash('success','操作成功');

        return redirect()->route('menus.index',['shop_id' => session('shop_id')]);

    }
}
