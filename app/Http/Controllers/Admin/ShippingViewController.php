<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingViewController extends Controller
{
    public function toIndex(){
        return view('Admin.Setting.Shipping.shipping');
    }
    public function toShippingEdit(){
        return view('Admin.Setting.Shipping.shipping-edit');
    }
    public function toShippingAdd(){
        return view('Admin.Setting.Shipping.shipping-add');
    }
}
