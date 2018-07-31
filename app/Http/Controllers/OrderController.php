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


        $shop_id = $request->shop_id;
        $shop_status = Shop::find($shop_id)->status;
        if ($shop_status != 1) {
            session()->flash('danger', '该店还未通过审核，请耐心等待');
            return redirect()->route('shopshow');
        }
        $status = ['0' => '待支付', '1' => '待发货', '2' => '待确认', '3' => '完成', '-1' => '已取消'];
        $orders = Order::where('shop_id', $shop_id)->orderBy('created_at', 'desc')->paginate(6);

        foreach ($orders as &$order) {

            $order->status = $status[$order->status];
        }
        //历史订单总数
        $hisCount = Order::where('shop_id', $shop_id)->count();
        //菜品总销量
        $menusCount=DB::select("select sum(o.amount)as menus from orders as a join order_goods as o on a.id=o.order_id   where a.shop_id={$shop_id}");

        return view('order.index', compact('orders', 'hisCount','menusCount'));

    }

    //查看订单详情
    public function showOrder(Order $order)
    {
        $status = ['0' => '待支付', '1' => '待发货', '2' => '待确认', '3' => '完成', '-1' => '已取消'];
        $order->status = $status[$order->status];
        $order_id = $order->id;
        $orderGoods = OrderGood::where('order_id', $order_id)->get();
        return view('order.show', compact('orderGoods', 'order'));
    }

    //发货
    public function Ship(Order $order, Request $request)
    {
        $order->update(['status' => $request->code]);

        session()->flash('success', '操作成功');

        return redirect()->route('orderList', ['shop_id' => $order->shop_id]);

    }

    //取消订单
    public function cancelOrder(Order $order)
    {
        $order->update(['status' => -1]);

        session()->flash('success', '取消订单成功');

        return redirect()->route('orderList', ['shop_id' => $order->shop_id]);
    }

    //查看订单统计
    public function orderCount(Request $request)
    {
        //查询出每天的订单数
        $current = $request->day??date('Y-m') . '%';

        $orderDay = DB::select("select count(id)as num,DATE_FORMAT(created_at, '%Y-%m-%d')as `day` from orders where shop_id={$request->shop_id} group by DATE_FORMAT(created_at, '%Y-%m-%d') HAVING `day` like '{$current}'");

        $data = [];
        $count = [];
        foreach ($orderDay as $order) {
            $patt = '/^\d{4}-\d{2}-(\d{2})$/';
            preg_match($patt, $order->day, $matches);
            $data[] = $matches[1];
            $count[] = $order->num;

        }
        $res['time']=isset($request->day)?$request->day:'';
        $res['data'] = $data;
        $res['count'] = $count;
        echo json_encode($res);

    }

    //每月订单统计
    public function orderMonth(Request $request)

    {
        $current = date('Y-m') . '%';
        if (isset($request->month)) {
            $whereMonth=$request->month;

            $current=$whereMonth.'%';
        }
        //查询出每月的订单数
        $orderMonth = DB::select("select count(id)as num,DATE_FORMAT(created_at, '%Y-%m')as `month` from orders where shop_id={$request->shop_id} group by DATE_FORMAT(created_at, '%Y-%m') HAVING `month` like '{$current}'");



        $data = [];
        $count = [];

        foreach ($orderMonth as $Month) {
            $patt = '/^\d{4}-(\d{2})$/';
            preg_match($patt, $Month->month, $matches);

            $data[] = $matches[1];
            $count[] = $Month->num;

        }
        $res['time']=$whereMonth??'';
        $res['data'] = $data;
        $res['count'] = $count;
        echo json_encode($res);

    }

    //每日菜品订单统计
    public function orderMenu(Request $request)
    {

        $current = date('Y-m-d') . '%';

        $whereMenu=$request->Dmenu??'';
        if ($whereMenu) {
            $current =$whereMenu . '%';
        }

        $dayOrderId = DB::select("select id from orders where shop_id={$request->shop_id} and created_at like '{$current}'");


        $data = [];
        foreach ($dayOrderId as $orderId) {

            //得到一条订单里面的所有商品
            $result = OrderGood::where('order_id', $orderId->id)->get(['goods_id', 'goods_name', 'amount']);
            //统计
            foreach ($result as $res) {

                if (!isset($data[$res->goods_name])) {

                    $data[$res->goods_name] = 0;
                    $data[$res->goods_name] += $res->amount;

                } else {
                    $data[$res->goods_name] += $res->amount;
                }

            }

        }
        $menu = array_keys($data);
        $values = array_values($data);
        echo json_encode(['data' => $menu, 'count' => $values,'time'=>$whereMenu]);

    }

    //每月菜品订单统计
    public function MonthMenuOrder(Request $request)
    {

        $current = date('Y-m') . '%';
        $whereMonth=$request->MonthMenu??'';
        if ($whereMonth) {
            $current = $whereMonth . '%';

        }
        $MomthOrderId = DB::select("select id from orders where shop_id={$request->shop_id} and created_at like '{$current}'");

        $data = [];

        foreach ($MomthOrderId as $orderId) {

            //得到一条订单里面的所有商品
            $result = OrderGood::where('order_id', $orderId->id)->get(['goods_id', 'goods_name', 'amount']);
            //统计
            foreach ($result as $res) {

                if (!isset($data[$res->goods_name])) {
                    $data[$res->goods_name]=0;
                     $data[$res->goods_name] += $res->amount;

                } else {
                    $data[$res->goods_name] += $res->amount;
                }

            }

        }
        $menu = array_keys($data);
        $values = array_values($data);
        echo json_encode(['data' => $menu, 'count' => $values,'time'=>$whereMonth]);

    }

}
