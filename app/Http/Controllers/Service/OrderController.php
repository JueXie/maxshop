<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Service;


use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Tool\UUID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderCreate(Request $request){
        $user_id = $request->get('user_id','');
        $address = $request->get('address','');
        $payment = $request->get('payment','');
        $cart_data = $request->get('cart_data','');

        // TODO 优惠券
        $coupon_id = $request->get('coupon_id','');


        $order_data = [];
        if ($user_id==''){
            return response('非法ID',203);
        }
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = "pending";
        $order_data['address'] = $address;
        $order_data['payment'] = $payment;
        $order_data['cart_data'] = $cart_data;
        $openid = User::find($user_id)->openid;
        if ($coupon_id != ""){
            //TODO 优惠券逻辑添加
        }else{
            //生成订单
            $order->order_data = serialize($order_data);
            $order->trade_no = UUID::createShort().date("YmdHis",intval(time()));
            $order->save();
            //减少库存
            $this->reduceStock($cart_data);
            //清空购物车
            $cart = Cart::where('user_id',$user_id)->first();
            $cart->content = serialize([]);
            $cart->save();
//            return response($order->order_id,200);
            //支付流程
            //1.判断支付方式
            switch ($payment){
                case "微信支付":
                    return $this->gotoWechatpayem($order->trade_no,$openid,$order->order_id);
                    break;
                case "支付宝":
                    $this->gotoAlipay();
                    break;
                default:
                    return response("支付方式不存在",404);
                    break;
            }
        }
    }
    //wx2995805d095ca479
    public function gotoWechatpayem($trade_no,$openid,$order_id){
        $wechat_pay = app('wechat.payment.default');
        $order = Order::find($order_id);
        $order_data = unserialize($order->order_data);
        $total_fee = $order_data['cart_data']['price'];
        $order = [
            'body' => '麦克斯商城',
            'out_trade_no' => $trade_no,
            'total_fee' => $total_fee,
            'notify_url' => 'http://maxshop.natapp1.cc/max_wechat/notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid' => $openid,
        ];
        $result = $wechat_pay->order->unify($order);
        if ($result['return_code']=="SUCCESS"){
            //返回支付函数
            $jssdk = $wechat_pay->jssdk;
            $config = $jssdk->bridgeConfig($result['prepay_id'], false);
            return response(array("data"=>$config,"order_id"=>$order_id));
        }else{
            return response($result);
        }

    }
    public function gotoAlipay(){

    }

    public function orderGet(Request $request){
        $order_id = $request->get('order_id','');
        $user_id = $request->get('user_id','-1');
        $status = $request->get('status','pending');
        $page = $request->get('page','0');

        if ($order_id!=''){
            //通过订单ID获取订单详情
            $order = Order::find($order_id);
            $order->order_data = unserialize($order->order_data);
            switch ($order->status){
                case "pending":
                    $order->status = "待支付";
                    break;
                case "paid":
                    $order->status = "待发货";
                    break;
                case "logistics":
                    $order->status = "运输中";
                    break;
                case "success":
                    $order->stauts = "已完成";
                    break;
                default:
                    return;
             }
            return response($order,200);
        }else{
            //其他方式获取订单列表，如订单状态
            $orders = Order::where('user_id',$user_id)->where('status',$status)->orderby('created_at','DESC')->offset($page*5)->take(5)->get();
            foreach ($orders as &$order){
                $order->order_data = unserialize($order->order_data);
            }
            if($orders->isEmpty()){
                return response('nomore');
            }else{
                return response($orders,200);
            }

        }
    }

    /**
     *
     * 减少库存（排他锁）
     */
    public function reduceStock($cart_data){
        $content = $cart_data['content'];
        foreach ($content as $item){
            DB::beginTransaction();
            try{
                //必须要主键索引，非主键索引检索，就会自动变成表锁
//                $product = Product::where('product_id',$item['product_id'])->lockForUpdate()->first();
                $res = DB::table('max_products')->where('product_id',$item['product_id'])->lockForUpdate()->first();
                if($res->stock) {

                    $num = DB::table('max_products')->where('product_id',$item['product_id'])->decrement('stock',intval($item['sub_count']));
                    if($num) {
                        // 提交事务
                        DB::commit();
                        $msg = "减少库存成功";
                    } else {
                        $msg = "减少库存失败";
                    }
                } else {
                    $msg ="库存不够";
                }
                //没问题就提交
                DB::commit();

            }catch (\Exception $exception){
                //有问题就回滚
                DB::rollBack();
                return response('库存减少发生错误',500);
            }
        }
    }
}
