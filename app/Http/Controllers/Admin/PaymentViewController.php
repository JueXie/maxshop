<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @data 2020-03-03
 * @time 0:05
 */


namespace App\Http\Controllers\Admin;



use App\Entity\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentViewController extends Controller
{
    public function toPayment(){
        $wechat = Payment::where('name','微信支付')->first();
        $wechatData = unserialize($wechat['payment_data']);
        return view('Admin.Setting.Payment.payment')->with('wechatData',$wechatData);
    }

}
