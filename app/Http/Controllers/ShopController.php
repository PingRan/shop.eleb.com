<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['uppassword', 'savepassword', 'shopshow']
        ]);
    }


    public function index()
    {
        $categories = ShopCategory::all();

        return view('shop.reg', compact('categories'));
    }

    public function store(Request $request)
    {

        $this->validate($request,
            [
                'name' => 'required|unique:users|between:6,12',
                'email' => 'required|unique:users|email',
                'password' => ['required', 'between:6,18', 'confirmed'],
                'shop_category_id' => ['required'],
                'shop_name' => ['required', 'max:20'],
                'shop_img' => ['required'],
                'start_send' => ['required'],
                'send_cost' => ['required'],
                'captcha' => ['required', 'captcha'],
            ], [
                'name.required' => '账号不能为空',
                'name.between' => '账号在6-12位之间',
                'name.unique' => '账号已存在',
                'email.required' => '邮箱不能为空',
                'email.email' => '邮箱格式不对',
                'email.unique' => '邮箱已存在',
                'shop_name.required' => '店铺名字不能为空',
                'shop_name.max' => '店铺名字在20位以内',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送金额不能为空',
                'password.required' => '密码必须填写',
                'password.between' => '密码在6-18位',
                'password.confirmed' => '密码和确认密码不一致！',
                'shop_img.required' => '请上传店铺图片',
                'captcha.required' => '验证码必须填写',
                'captcha.captcha' => '验证码出错',
            ]
        );


        $request['brand'] = $request->brand??0;
        $request['on_time'] = $request->on_time??0;
        $request['fengniao'] = $request->fengniao??0;
        $request['bao'] = $request->bao??0;
        $request['piao'] = $request->piao??0;
        $request['zhun'] = $request->zhun??0;


        $request['shop_rating'] = mt_rand(1,4).'.'.mt_rand(0,9);

        $request['status'] = 0;

        $request['password'] = bcrypt($request->password);


        DB::beginTransaction();

        try {
            $shop = Shop::create($request->input());
            $shop_id = $shop->id;
            $request['shop_id'] = $shop_id;

            $user=User::create($request->input());

            ShopUser::create(['user_id'=>$user->id,'shop_id'=>$shop_id]);

            DB::commit();
            session()->flash('success', '注册成功,审核结果在3个工作日内下达');
        } catch (\Exception $e) {
            session()->flash('danger', '注册失败');
            DB::rollBack();
        }

        return redirect()->route('shop.home');


    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('shop.home');
        }
        return view('shop.login');
    }

    public function check(Request $request)
    {
        $this->validate($request,
            [
                'name' => ['required'],
                'password' => ['required'],
                'captcha' => ['required', 'captcha'],
            ],
            [
                'name.required' => '请填写账号',
                'password.required' => '请填写密码',
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '验证码出错',
            ]
        );


        if (Auth::attempt(['name' => $request->name, 'password' => $request->password], $request->remberme)) {

            $userinfo = Auth::user();
            $shopstatus = $userinfo->shops()->first()->status;//登录还需优化.
            if ($shopstatus != 1 || !$userinfo->status) {
                Auth::logout();
                session()->flash('danger', '该账号未激活或商铺还未通过审核');
                return back()->withInput();
            }
            session()->flash('success','登录成功');
            return redirect()->route('shop.home');

        } else {
            session()->flash('danger', '账号或者密码错误');

            return back()->withInput();
        }
    }

    public function loginout()
    {
        Auth::logout();

        session()->flash('success', '注销成功');

        return redirect()->route('shop.home');
    }

    public function uppassword()
    {
        $userinfo = Auth::user();

        return view('shop.uppassword', compact('userinfo'));
    }

    public function savepassword(Request $request)
    {
        $this->validate($request,
            [
                'oldpassword' => ['required'],
                'newpassword' => ['required', 'between:6,18', 'confirmed'],
                'email' => ['required', Rule::unique('users')->ignore(Auth()->id())]
            ],
            [
                'name.required' => '账号不能为空',
                'name.max' => '账号不能超过15个字符',
                'name.unique' => '账号已存在',
                'email.required' => '邮箱不能为空',
                'email.email' => '邮箱格式不对',
                'email.unique' => '邮箱已存在',
                'oldpassword.required' => '请填写旧密码',
                'newpassword.confirmed' => '新密码和确认密码不一致',
                'newpassword.required' => '新密码必须填写',
                'newpassword.between' => '新密码在6-18位',
            ]
        );

        $userinfo = Auth()->user();
        $oldpassword = $userinfo->password;

        $result = Hash::check($request->oldpassword, $oldpassword);

        if ($result) {

            if (Hash::check($request->newpassword, $oldpassword)) {
                session()->flash('danger', '新密码与旧密码一致');
                return back()->withInput();
            }

            $newpassword = bcrypt($request->newpassword);

            $userinfo->update(['password' => $newpassword, 'email' => $request->email]);

            session()->flash('success', '修改成功,请重新登录');
            Auth::logout();
            return redirect()->route('login');

        } else {
            session()->flash('danger', '旧密码错误');
            return back()->withInput();
        }
    }

    public function shopshow()
    {
        if (!Auth::check()) {
            session()->flash('success', '请登录');
            return redirect()->route('shop.home');
        }

        $user_id=Auth()->id();

        $shops= ShopUser::where('user_id',$user_id)->get();//得到所有的店铺id

        $shopall=[];

        foreach ($shops as $shop){
            $shopall[]=$shop->shop_id;
        }

        $datashop=Shop::whereIn('id',$shopall)->get();


        return view('shop.shopshow', compact('datashop'));
    }

    public function edit(Shop $shop)
    {
        $categories = ShopCategory::all();

        return view('shop.edit', compact('shop', 'categories'));
    }

    public function updateshop(Request $request, Shop $shop)
    {

        $this->validate($request,
            [
                'shop_category_id' => ['required'],
                'shop_name' => ['required', 'max:20'],
//                'shop_img' => ['required'],
                'start_send' => ['required'],
                'send_cost' => ['required'],
            ], [
                'shop_name.required' => '店铺名字不能为空',
                'shop_name.max' => '店铺名字在20位以内',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送金额不能为空',
                'shop_img.dimensions' => '请上传一张图片',
            ]
        );

        $data = ['shop_name' => $request->shop_name, 'shop_category_id' => $request->shop_category_id, 'start_send' => $request->start_send, 'send_cost' => $request->send_cost, 'status' => $shop->status];


        $data['brand'] = $request->brand??0;
        $data['on_time'] = $request->on_time??0;
        $data['fengniao'] = $request->fengniao??0;
        $data['bao'] = $request->bao??0;
        $data['piao'] = $request->piao??0;
        $data['zhun'] = $request->zhun??0;

        $data['shop_rating'] =mt_rand(1,4).'.'.mt_rand(0,9);//商店评分要优化

        if ($request->notice) {
            $data['notice'] = $request->notice;
        }

        if ($request->discount) {
            $data['discount'] = $request->discount;
        }


        if ($request->shop_img) {

            $data['shop_img']=$request->shop_img;
        }


        $shop->update($data);

        session()->flash('success', '修改成功');

        return redirect()->route('shop.home');

    }

    public function showall(Request $request)
    {
        $user_id=$request->id;
        $shops= ShopUser::where('user_id',$user_id)->get();//得到所有的店铺id

        $shopall=[];

        foreach ($shops as $shop){
            $shopall[]=$shop->shop_id;
        }

        $datashop=Shop::whereIn('id',$shopall)->get();


        return view('shop.showall',compact('datashop'));
    }

    public function addshop(Request $request)
    {
        //子账号不能开分店
        if(Auth::user()->child){
            session()->flash('danger','子账号不能开分店');
            return redirect()->route('shopshow');
        }
        $user_id=$request->id;
        $categories = ShopCategory::all();

        return view('shop.addshop',compact('user_id','categories'));
    }
    //保存指定商户
    public function saveshop(Request $request)
    {

        if($request->adduser){

            $this->validate($request,
                [
                    'name' => 'required|between:6,12|unique:users',
                    'email' => 'required|unique:users|email',
                    'password' => ['required', 'between:6,18', 'confirmed'],
                    'shop_category_id' => ['required'],
                    'shop_name' => ['required', 'max:20'],
                    'shop_img' => ['required'],
                    'start_send' => ['required'],
                    'send_cost' => ['required'],
                ], [
                    'name.required' => '账号不能为空',
                    'name.max' => '账号为6-12个字符',
                    'name.unique' => '账号已存在',
                    'email.required' => '邮箱不能为空',
                    'email.email' => '邮箱格式不对',
                    'email.unique' => '邮箱已存在',
                    'shop_name.required' => '店铺名字不能为空',
                    'shop_name.max' => '店铺名字在20位以内',
                    'start_send.required' => '起送金额不能为空',
                    'send_cost.required' => '配送金额不能为空',
                    'password.required' => '密码必须填写',
                    'password.between' => '密码在6-18位',
                    'password.confirmed' => '密码和确认密码不一致！',
                    'shop_img.required' => '请上传店铺图片'
                ]
            );


            $request['brand'] = $request->brand??0;
            $request['on_time'] = $request->on_time??0;
            $request['fengniao'] = $request->fengniao??0;
            $request['bao'] = $request->bao??0;
            $request['piao'] = $request->piao??0;
            $request['zhun'] = $request->zhun??0;

            $request['shop_rating'] = mt_rand(1,4).'.'.mt_rand(0,9);

            $request['status'] =0;

            $request['password'] = bcrypt($request->password);


            DB::beginTransaction();

            try {

                $shop = Shop::create($request->input());

                $shop_id = $shop->id;//店铺的主键

                $request['shop_id'] = $shop_id;
                $request['child'] = 1;
                $user=User::create($request->input());

                $user_id=$user->id;

                ShopUser::create(['shop_id'=>$shop_id,'user_id'=>$user_id]);

                ShopUser::create(['shop_id'=>$shop_id,'user_id'=>$request->id]);

                DB::commit();

                session()->flash('success', '添加和注册成功');

                return redirect()->route('shopshow');

            } catch (\Exception $e) {
                session()->flash('danger', '注册失败');
                DB::rollBack();
                dd($e);
            }

        }else{

            $this->validate($request,
                [
                    'shop_category_id' => ['required'],
                    'shop_name' => ['required', 'max:20'],
                    'shop_img' => ['required'],
                    'start_send' => ['required'],
                    'send_cost' => ['required'],
                ],
                [
                    'shop_name.required' => '店铺名字不能为空',
                    'shop_name.max' => '店铺名字在20位以内',
                    'start_send.required' => '起送金额不能为空',
                    'send_cost.required' => '配送金额不能为空',
                    'shop_img.required' => '请上传店铺图片'
                ]
            );


            $request['brand'] = $request->brand??0;
            $request['on_time'] = $request->on_time??0;
            $request['fengniao'] = $request->fengniao??0;
            $request['bao'] = $request->bao??0;
            $request['piao'] = $request->piao??0;
            $request['zhun'] = $request->zhun??0;

            $request['shop_rating'] = mt_rand(1,4).'.'.mt_rand(0,9);

            $request['status'] =0;

            try {
                DB::beginTransaction();

                $shop = Shop::create($request->input());

                $shop_id = $shop->id;//店铺的主键

                $user_id=$request->id;

                ShopUser::create(['shop_id'=>$shop_id,'user_id'=>$user_id]);

                DB::commit();

                session()->flash('success', '添加商铺成功');

            } catch (\Exception $e) {
                session()->flash('danger', '注册失败');
                DB::rollBack();
                dd($e);
            }

            session()->flash('success','注册成功');

            return redirect()->route('shopshow');

        }








    }

    //查看指定账号下的所有商铺


}
