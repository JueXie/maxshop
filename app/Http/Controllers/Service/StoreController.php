<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-19-019
 * @time 16:29
 */


namespace App\Http\Controllers\Service;


use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function getShopInfo(){
        $shopInfo = [];
        $shopInfo['name']='测试商店';
        $shopInfo['address'] = '广东省广州市';
        return $shopInfo;
    }
    public function getShopIndex(){

    }
}
