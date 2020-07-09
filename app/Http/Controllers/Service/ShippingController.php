<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Service;



use App\Entity\Shipping;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
   public function shippingAdd(Request $request){
        $name = $request->get('name','');
        $status = $request->get('status','');
        $status_arr = $request->get('status_arr','');
        $cost_arr = $request->get('cost_arr','');
        $address_arr = $request->get('address_arr','');
        //对数值的初始化
        foreach ($cost_arr as &$item){
            if (!is_numeric($item)){
                return response('输入的值不是数字类型',202);
            }
            $item = number_format((float)$item,2);
        }

        $shipping_data = [];
        $i=0;
        foreach ($address_arr as $item){
            array_push($shipping_data,[$item=>['cost'=>$cost_arr[$i],'status'=>$status_arr[$i]]]);
            $i++;
        }
        $shipping = new Shipping();
        $shipping->name = $name;
        $shipping->status = $status;
        $shipping->shipping_data = serialize($shipping_data);
        $shipping->save();
       return response('添加成功',200);
   }
}
