<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-04-004
 * @time 16:26
 */


namespace App\Http\Controllers\Admin;


use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductMeta;
use App\Http\Controllers\Controller;

class ProductViewController extends Controller
{
    public function toProductList(){
        $products = Product::where('parent_id','0')->paginate(10);
        foreach ($products as &$product){
            if ($product->category_id != 0){
                $category = Category::find($product->category_id);
                if(!is_null($category)){
                    $product->category_id = $category->name;
                }else{
                    $product->category_id = '已删除的分类';
                }
            }
            if ($product->type =='variable'){
                $attr = Product::where('parent_id',$product->product_id)->get()->sortBy('normal_price')->toArray();
                $length = count($attr)-1;
                $product['price_limit'] = $attr[0]['normal_price'].'~'.$attr[$length]['normal_price'];
            }
        }
        return view('Admin.Product.product-list')->with('products',$products);
    }
    public function toProductAdd(){
        $categories = Category::all();
        return view('Admin.Product.product-add')->with('categories',$categories);
    }
    public function toEditProduct($product_id){
        $product = Product::find($product_id)->toArray();
        //解序列化
        $product['slide_img'] = unserialize($product['slide_img']);
        $product['content'] = unserialize($product['content']);
        //如果是商品组,获取商品组属性
        $attr = [];
        if ($product['type']=='variable'){
            $attr = Product::where('parent_id',$product['product_id'])->get()->toArray();
        }
        $meta = [];
        $meta_data = ProductMeta::where('product_id',$product_id)->get();
        foreach ($meta_data as $data){
            $meta = array_merge($meta,[$data['slug']=>[$data['meta_key']=>unserialize($data['meta_value'])]]);
        }
        //全部分类
        $categories = Category::all()->toArray();

        $self_cate = Category::find($product['category_id']);
        if ($self_cate==null){
            $self_cate = ['category_id'=>-1,"name"=>"未分类"];
        }else{
            $self_cate->toArray();
        }
        //把自身的分类unshift到数组中
        $key = array_search($self_cate,$categories);
        unset($categories[$key]);
        array_unshift($categories,$self_cate);
        return view('Admin.Product.product-edit')->with('product',$product)->with('meta',$meta)->with('attr',$attr)->with('categories',$categories);
    }

}
