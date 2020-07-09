<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Service;



use App\Entity\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NotifyController extends Controller
{

    public function wechatNotify(Request $request){

        $wechat_pay = app('wechat.payment.default');
        //
        $response = $wechat_pay->handlePaidNotify(function ($message, $fail) use ($request){
            if($message['return_code'] === 'SUCCESS'){
                $order = Order::where('trade_no',$message['out_trade_no'])->first();
                $order->status="paid";
                $order->save();
                return true;
            }else{
                return $fail('通信失败，请稍后再通知我');
            }


        });
        return $response;
    }

}
