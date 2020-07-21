<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Service;


use App\Entity\Activity;
use App\Entity\Cart;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
   public function getActivityByName(Request $request){
       $activity_name = $request->get('name','');
       $activity = Activity::where('activity_name',$activity_name)->first()->toArray();
       $activity['activity_data'] = unserialize($activity['activity_data']);
       $product = Product::find($activity['activity_data']['product_id'])->toArray();
       $product['slide_img'] = unserialize($product['slide_img']);
       $res = array_merge($activity,['product'=>$product]);
       return response($res);
   }
}
