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
use App\Entity\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**获取购物车列表
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     */
    public function getCart(Request $request){
        $user_id = $request->get('user_id','');
        $cart = $this->getCartByUserId($user_id);
        return response($cart,200);
    }

    /**点击加入购物车/购物车列表点击“+”触发
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     */
    public function addToCart(Request $request){
        $product_id = $request->get('product_id','');
        $count = $request->get('count','');
        $user_id = $request->get('user_id','');
        //找到对应user_id的购物车对象
        $cart = Cart::where('user_id',$user_id)->first();
        //如果为空，就创建一个购物车对象,否者就添加进去
        if (is_null($cart)){
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->content = serialize([$product_id=>$count]);
            $cart->save();
        }else{
            $content = unserialize($cart->content);
            if(array_key_exists($product_id,$content)){
                $value = $content[$product_id];
                $value = $value + $count;
                $content[$product_id] = $value;
                $cart->content = serialize($content);
                $cart->save();
            }else{
                $content[$product_id] = $count;
                $cart->content = serialize($content);
                $cart->save();
            }
        }
        $cart = $this->getCartByUserId($user_id);
        return response($cart,200);
    }

    /**购物车列表点击“-”触发
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     */
    public function reduceCart(Request $request){
        $product_id = $request->get('product_id','');
        $user_id = $request->get('user_id','');
        //找到对应user_id的购物车对象
        $cart = Cart::where('user_id',$user_id)->first();
        $content = unserialize($cart->content);
        $value = $content[$product_id];
        if ($value==1){
            unset($content[$product_id]);
            $cart->content = serialize($content);
            $cart->save();
        }else{
            $value = $value - 1;
            $content[$product_id] = $value;
            $cart->content = serialize($content);
            $cart->save();
        }
        $cart = $this->getCartByUserId($user_id);
        return response($cart,200);
    }

    /**输入数量更新购物车
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     */
    public function updateCartWithCount(Request $request){
        $product_id = $request->get('product_id','');
        $count = $request->get('count','');
        $user_id = $request->get('user_id','');

        $cart = Cart::where('user_id',$user_id)->first();
        if ($count=='0'){
            $content = unserialize($cart->content);
            unset($content[$product_id]);
            $cart->content = serialize($content);
            $cart->save();
        }else{
            $content = unserialize($cart->content);
            $content[$product_id] = $count;
            $cart->content = serialize($content);
            $cart->save();
        }

        $cart = $this->getCartByUserId($user_id);
        return response($cart,200);
    }

    /**
     *
     * 非路由方法
     */

    /**
     * @param $user_id
     * @return array
     */
    protected function getCartByUserId($user_id){
        $cart = Cart::where('user_id',$user_id)->first();
        if (!is_null($cart)){
            $res = [];
            $total = 0;
            $normal_price = 0;
            $price = 0;
            $content = unserialize($cart->content);//content数组
            foreach ($content as $key=>$value){
                //$key是商品ID，$value是商品数量
                $product = Product::find($key);
                $product['count'] = $value;
                $item_hot_sale_price = 0;
                $item_normal_price = $value*$product->normal_price;
                $normal_price = $normal_price+$item_normal_price;
                if ($product->hot_sale_price != 0.00){
                    $item_hot_sale_price = $value*$product->hot_sale_price;
                    $price = $price+$item_hot_sale_price;
                }else{
                    $item_hot_sale_price = $value*$product->normal_price;
                    $price = $price+$item_hot_sale_price;
                }
                $res['content']['product_'.$key]['normal_price'] = (float)sprintf("%.2f",$item_normal_price);
                $res['content']['product_'.$key]['sub_total'] = (float)sprintf("%.2f",$item_hot_sale_price);
                $res['content']['product_'.$key]['sub_count'] = $value;

                $res['content']['product_'.$key]['title'] = $product->title;
                $res['content']['product_'.$key]['product_id'] = $product->product_id;
                $res['content']['product_'.$key]['main_img'] = $product->main_img;
                $total = $total+$value;
            }
            $res['count']=$total;
            $res['normal_price']=(float)sprintf("%.2f",$normal_price)*100;
            $res['price']=(float)sprintf("%.2f",$price)*100;
            return $res;
        }else{
            return [];
        }
    }
}
