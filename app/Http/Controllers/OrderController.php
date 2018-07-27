<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //订单列表
    public function index(Request $request)
    {

        $shop_id=$request->shop_id;
        $shop_status=Shop::find($shop_id)->status;
        if($shop_status!=1){
            session()->flash('danger','该店还未通过审核，请耐心等待');
            return redirect()->route('shopshow');
        }
        $status=['0'=>'待支付','1'=>'待发货','2'=>'待确认','3'=>'完成','-1'=>'已取消'];
        $orders=Order::where('shop_id',$shop_id)->orderBy('created_at','desc')->paginate(6);



        foreach ($orders as &$order){
            $order->status=$status[$order->status];
        }

        return view('order.index',compact('orders','dayOrder'));

    }

    //查看订单详情
    public function showOrder(Order $order)
    {
       $status=['0'=>'待支付','1'=>'待发货','2'=>'待确认','3'=>'完成','-1'=>'已取消'];
       $order->status=$status[$order->status];
       $order_id=$order->id;
       $orderGoods=OrderGood::where('order_id',$order_id)->get();
       return view('order.show',compact('orderGoods','order'));
    }
    //发货
    public function Ship(Order $order,Request $request)
    {
        $order->update(['status'=>$request->code]);

        session()->flash('success','操作成功');

        return redirect()->route('orderList',['shop_id'=>$order->shop_id]);

    }
    //取消订单
    public function cancelOrder(Order $order)
    {
        $order->update(['status'=>-1]);

        session()->flash('success','取消订单成功');

        return redirect()->route('orderList',['shop_id'=>$order->shop_id]);
    }
    //查看订单统计
    public function orderCount(Request $request)
    {
        //查询出每天的订单数
        $orderDay=DB::select("select count(id),DATE_FORMAT(created_at, '%Y-%m-%d')as `day` from Orders where shop_id={$request->shop_id} group by DATE_FORMAT(created_at, '%Y-%m-%d')");

        //查询出每月的订单数
        $orderMonth=DB::select("select count(id),DATE_FORMAT(created_at, '%Y-%m')as `month` from orders where shop_id={$request->shop_id} group by DATE_FORMAT(created_at, '%Y-%m')");

        dd($orderMonth);
    }

}
