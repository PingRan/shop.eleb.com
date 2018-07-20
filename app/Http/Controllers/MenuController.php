<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
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
       $category_id=$request->category_id;

        $menucategories=MenuCategory::all();

        $menus=Menu::paginate(10);

       if($category_id){
           $menus=Menu::where('category_id',$category_id)->paginate(10);
       }

       return view('menu.index',compact('menus','menucategories','category_id'));
    }

    public function create()
    {
        $menucategories=MenuCategory::all();

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
               'goods_img'=>['required', 'dimensions:min_width=1,min_height=1'],
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
               'goods_img.required'=>'菜品图片不能为空',
               'goods_img.dimensions'=>'请上传菜品图片',
           ]
       );

       if($request->goods_img){

        $fileName=$request->goods_img->store('public/goods_img');

        $request['goods_img']=url(Storage::url($fileName));

       }else{

           $request['goods_img']='0';
       }


       $request['shop_id']=Auth::user()->shop_id;

       Menu::create($request->input());

       session()->flash('success','菜品添加成功');

       return redirect()->route('menus.index');
    }

    public function edit(Menu $menu)
    {
       $menucategories=MenuCategory::all();

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
                'goods_img'=>['dimensions:min_width=1,min_height=1'],
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
                'goods_img.required'=>'菜品图片不能为空',
                'goods_img.dimensions'=>'请上传菜品图片',
            ]
        );

        $data=['goods_name'=>$request->goods_name,'category_id'=>$request->category_id,'goods_price'=>$request->goods_price,'tips'=>$request->tips,'description'=>$request->description];

        if($request->goods_img){
            $fileName=$request->goods_img->store('public/goods_img');
            $data['goods_img']=url(Storage::url($fileName));

        }

        $menu->update($data);

        session()->flash('success','菜品修改成功');

        return redirect()->route('menus.index');


    }


    public function destroy(Menu $menu)
    {
       $menu->delete();

       echo '删除成功';
    }


    public function showmenus(Request $request)
    {
        $category_id=$request->category_id;

        $menus=Menu::where('category_id',$category_id)->get('goods_name');

        return view('menu.showmenus',compact('menus'));
    }


    public function show(Menu $menu)
    {
        return view('menu.show',compact('menu'));
    }
}
