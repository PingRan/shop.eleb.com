<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MenuCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
            'except '=>[]
        ]);
    }

    public function index()
    {
        $menucategories=MenuCategory::all();

        return view('menucategory.index',compact('menucategories'));
    }

    public function create()
    {
        return view('menucategory.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required|max:20|unique:menu_categories',
                'description'=>'required|max:150',
                'is_selected'=>'unique:menu_categories'
            ],
            [
               'name.required'=>'菜品分类名字不能为空',
                'name.max:20'=>'菜品分类名字不能超过20个字',
                'name.unique'=>'菜品分类名字已存在',
                'description.required'=>'菜品分类的描述不能为空',
                'description.max'=>'菜品分类的描述不能超过150个字',
                'is_selected.unique'=>'已存在默认菜品分类',
            ]
        );
        $request['type_accumulation']=uniqid();

        $shop_id=Auth::user()->shop_id;

        $request['shop_id']=$shop_id;

        $is_selected=MenuCategory::where('is_selected',1)->first();

        if(!$is_selected&&!$request->is_selected){
            session()->flash('danger','请设置为默认菜品分类');
            return back()->withInput();
        }

        MenuCategory::create($request->input());


        session()->flash('success','添加成功');

        return redirect()->route('menucategories.index');
    }

    public function edit(MenuCategory $menucategory)
    {
      return view('menucategory.edit',compact('menucategory'));
    }

    public function update(Request $request,MenuCategory $menucategory)
    {
        $this->validate($request,
            [
                'name'=>['required','max:20',Rule::unique('menu_categories')->ignore($menucategory->id)],
                'description'=>'required|max:150',
                'is_selected'=>'unique:menu_categories'
            ],
            [
                'name.required'=>'菜品分类名字不能为空',
                'name.unique'=>'菜品分类名字已存在',
                'name.max:20'=>'菜品分类名字不能超过20个字',
                'description.required'=>'菜品分类的描述不能为空',
                'description.max'=>'菜品分类的描述不能超过150个字',
                'is_selected.unique'=>'已存在默认菜品分类',
            ]
        );
        $shop_id=Auth::user()->shop_id;

        $request['shop_id']=$shop_id;

        $menucategory->update(['name'=>$request->name,'description'=>$request->description]);

        session()->flash('success','修改成功');

        return redirect()->route('menucategories.index');

    }


    public function destroy(MenuCategory $menucategory)
    {

        $id=$menucategory->id;

        $a=MenuCategory::where('id',$id)->withCount('menus')->first();

        $menus=$a->menus_count;

        $success=['success'=>true];

        if($menus>0){
            $success=['success'=>false];
            $res=json_encode($success);
            echo $res;
            return ;
        }

        $menucategory->delete();
        $res=json_encode($success);
        echo $res;

    }

    public function is_selected(MenuCategory $menucategory)
    {
        if($menucategory->is_selected){
            session()->flash('danger','已经是默认菜品分类了');

            return redirect()->route('menucategories.index');
        }
       MenuCategory::where('is_selected',1)->update(['is_selected'=>0]);

       $menucategory->update(['is_selected'=>1]);

        session()->flash('success','设置菜品分类成功');

       return redirect()->route('menucategories.index');
    }
}
