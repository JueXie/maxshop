<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-04-12-012
 * @time 16:19
 */


namespace App\Http\Controllers\Service;


use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\User;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function checkout(Request $request){
        $data = $request->get('order_info','');
        $payment = $request->get('payment','');
        $user_id = $request->get('user_id','');
        $address = $request->get('address','');
        $order_id = $data['order_id'];
        $order_data = $data['order_data'];

        $order = Order::find($order_id);
        $order_data['address'] = $address;
        $order_data['payment'] = $payment;
        $res = $this->maxPay($user_id,$payment,$order_data);

        return $res;

    }

    private function maxPay($user_id,$payment,$order_data){
        switch ($payment){
            case '微信支付':
                $this->wechatPay($user_id,$order_data);
                break;
        }
    }

    private function wechatPay($user_id,$order_data){
        $user = User::find($user_id);
        $openid = $user->openid;
        $payObj = Payment::where('name','微信支付')->first();
        $payData = unserialize($payObj->payment_daata);
        $config = [

            'app_id'             => $payData['app_id'],
            'mch_id'             => $payData['mch_id'],
            'key'                => $payData['mch_key'],   // API 密钥
        ];
        $wechatPay = Factory::payment($config);
        $result = $wechatPay->order->unify([
            'body' => $payData['mch_title'],
            'out_trade_no' => $order_data['order_num'],
            'total_fee' => $order_data['order_data']['cart_data']['price'],
            'trade_type' => 'JSAPI',
            'openid' => $openid,
        ]);
    }

}
