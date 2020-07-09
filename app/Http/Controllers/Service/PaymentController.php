<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Service;



use App\Entity\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getPayment(Request $request){
        //客户端类型共5种:PC(PC),h5(H5),小程序(miniProgram)，安卓(android)，ios(IOS)
        $type = $request->get('type','');

        //根据客户端类型返回可使用的支付网关
        switch ($type){
            case 'wechatMiniProgram':
                return $this->getMiniProgramPayment();
                break;
            default:
                return $this->getAllPayment();
        }
    }
    public function paymentAdd(Request $request){
        return '访问成功';
    }
    public function paymentUpdate(Request $request){
        $paymentData = $request->all();
        $name = $paymentData['name'];
        unset($paymentData['_token']);
        unset($paymentData['name']);
        $payment = Payment::firstOrNew(['name'=>$name]);
        $payment->payment_data = serialize($paymentData);
        $payment->save();
        return response('保存成功',200);
    }


    /**
     *
     * 非路由方法
     */

    /**
     *获取小程序的支付网关
     */
    public function getMiniProgramPayment(){
        $payment = Payment::where('name','微信支付')->get();
        foreach ($payment as &$item){
            unset($item['payment_data']);
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['preview_img'] = env('APP_URL').$item['preview_img'];
        }
        return $payment;
    }

}
