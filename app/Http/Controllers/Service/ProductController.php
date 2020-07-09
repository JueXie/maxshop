<?php

namespace App\Http\Controllers\Service;





use App\Entity\Product;
use App\Entity\ProductMeta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     *
     * 路由方法
     */

    /**
     * @param Request $request
     * @return string
     *
     */
    public function productAdd(Request $request){
        //获取数据
        $title = $request->get('title','');
        $info = $request->get('info','');
        $type = $request->get('type','');
        $stock = $request->get('stock','');
        $main_img = $request->get('main_img','');
        $category_id = $request->get('cid','');
        $slide_img = $request->get('slide_img','');
        $content = $request->get('content_img','');
        $normal_price = $request->get('normal_price','');
        $hot_sale_price = $request->get('hot_sale_price','');
        $status = $request->get('status','');

        //新建以及保存商品
        $product = new Product();

        $product->title = $title;
        $product->info = $info;
        $product->type = $type;

        $product->main_img = $main_img;
        $product->category_id = (int)$category_id;
        $product->slide_img = serialize($slide_img);
        $product->content = serialize($content);
        $product->status = $status;

        if ($type == 'variable'){
            $attr_name_arr = $request->get('attr_name','');
            $attr_price_arr = $request->get('attr_price','');
            $attr_stock_arr = $request->get('attr_stock','');
            $attr_status_arr = $request->get('attr_status','');
            $attr_preview_img_arr = $request->get('attr_preview_img','');
            $product->stock = 0;
            $product->normal_price = 0;
            $product->hot_sale_price = 0;
            $product->save();

            for ($i=0;$i<count($attr_name_arr);$i++){
                $attr = new Product();
                $attr->parent_id = $product->product_id;
                $attr->type = 'child';
                $attr->main_img = $attr_preview_img_arr[$i];
                $attr->title = $attr_name_arr[$i];
                $attr->normal_price = $attr_price_arr[$i];
                $attr->stock = $attr_stock_arr[$i];
                $attr->status = $attr_status_arr[$i];
                $attr->save();
            }
        }else{
            $product->stock = $stock;
            $product->normal_price = (float)$normal_price;
            $product->hot_sale_price = (float)$hot_sale_price;
            $product->save();
        }
        $sales = new ProductMeta();
        $sales->product_id = $product->product_id;
        $sales->slug = '销量';
        $sales->meta_key = 'sales';
        $sales->meta_value = serialize(0);
        $sales->save();

        return response('发布成功',200);
    }


    public function getProducts(Request $request){
        $pre_page = $request->get('pre_page','10');
        $page = $request->get('page','0');
        $order_by = $request->get('order_by','product_id');
        $category_id = $request->get('category_id','');
        $search = $request->get('search','');
        //找出产品
        if ($category_id==''){
            $products = Product::query()->where('status','=','public')->where('parent_id','=',0)->orderBy($order_by,'Desc')->offset($page*$pre_page)->take($pre_page)->get()->toArray();
        }else{
            $products = Product::query()->where('category_id','=',$category_id)->where('status','=','public')->where('parent_id','=',0)->orderBy($order_by,'Desc')->offset($page*$pre_page)->take($pre_page)->get()->toArray();
        }

        //解序列化数据
        foreach ($products as &$product){
            $product['slide_img'] = unserialize($product['slide_img']);
            $product['content'] = unserialize($product['content']);
            if ($product['type']=='variable'){
                $attr = $this->getProductChild($product['product_id']);
                $product['attrs'] = $attr;
            }
            $meta = $this->getProductMetaData($product['product_id']);
            if (is_array($meta)){
                $product = array_merge($product,$meta);
            }

        }
        return $products;
    }

    public function getProductByID($product_id){

        $product = Product::find($product_id)->toArray();
        if (!is_null($product)){
            if ($product['type']=='variable'){
                $attr = $this->getProductChild($product_id);
                $product['attrs'] = $attr;
            }
            $product['content'] = unserialize($product['content']);
            $product['slide_img'] = unserialize($product['slide_img']);
            $meta = $this->getProductMetaData($product_id);
            if (is_array($meta)){
                $product = array_merge($product,$meta);
            }
            return $product;
        }else{
            return response('没有找到商品',404);
        }
    }

    public function changeStatus(Request $request){
        $id = $request->get('id','');
        $status = $request->get('status','');
        if ($status=='public'){
            $status='pending';
        }else{
            $status='public';
        }
        $product = Product::find($id);
        $product->status = $status;
        $product->save();
        return response('修改状态成功',200);
    }
    public function deleteProduct(Request $request){
        $id = $request->get('id');
        Product::destroy($id);
    }
    public function productEdit(Request $request){
        //获取数据
        $product_id = $request->get('product_id','');
        $title = $request->get('title','');
        $info = $request->get('info','');
        $type = $request->get('type','');
        $stock = $request->get('stock','');
        $main_img = $request->get('main_img','');
        $category_id = $request->get('cid','');
        $slide_img = $request->get('slide_img','');
        $content = $request->get('content_img','');
        $normal_price = $request->get('normal_price','');
        $hot_sale_price = $request->get('hot_sale_price','');
        $status = $request->get('status','');

        $product = Product::find($product_id);
        $product->title = $title;
        $product->info = $info;
        $product->type = $type;
        $product->main_img = $main_img;
        $product->category_id = (int)$category_id;
        $product->slide_img = serialize($slide_img);
        $product->content = serialize($content);
        $product->status = $status;

        if ($type == 'variable'){
            $attr_name_arr = $request->get('attr_name','');
            $attr_price_arr = $request->get('attr_price','');
            $attr_stock_arr = $request->get('attr_stock','');
            $attr_status_arr = $request->get('attr_status','');
            $attr_preview_img_arr = $request->get('attr_preview_img','');
            $attr_ids = $request->get('attr_id','');

            $product->stock = 0;
            $product->normal_price = 0;
            $product->hot_sale_price = 0;

            $product->save();

            for ($i=0;$i<count($attr_name_arr);$i++){
                if ($attr_ids[$i]=='0'){
                    $attr = new Product();
                    $attr->parent_id = $product->product_id;
                    $attr->main_img = $attr_preview_img_arr[$i];
                    $attr->type = 'child';
                    $attr->title = $attr_name_arr[$i];
                    $attr->normal_price = $attr_price_arr[$i];
                    $attr->stock = $attr_stock_arr[$i];
                    $attr->status = $attr_status_arr[$i];
                    $attr->save();
                }else{
                    $attr = Product::find($attr_ids[$i]);
                    $attr->parent_id = $product->product_id;
                    $attr->main_img = $attr_preview_img_arr[$i];
                    $attr->title = $attr_name_arr[$i];
                    $attr->normal_price = $attr_price_arr[$i];
                    $attr->stock = $attr_stock_arr[$i];
                    $attr->status = $attr_status_arr[$i];
                    $attr->save();
                }

            }
        }else{
            $product->stock = (int)$stock;
            $product->normal_price = (float)$normal_price;
            $product->hot_sale_price = (float)$hot_sale_price;
            $product->status = $status;
            $product->save();
        }
        //todo 自定义数据修改


        return response('修改成功',200);
    }


    /**
     * -----------以下是逻辑控制器的方法   TODO 后面要分离出去------------------------
     * @param $product_id
     * @return mixed
     *
     */
    public function getProductChild($product_id){
        $attrs = Product::where(['parent_id'=>$product_id,'status'=>'public'])->get()->sortBy('normal_price')->toArray();
        $length = count($attrs)-1;
        if (!empty($attrs)){
            $attrs['price_limits'] = $attrs[0]['normal_price'].'~'.$attrs[$length]['normal_price'];
        }
        return $attrs;
    }

    /**
     * @param $product_id
     * @return array
     * TODO getMetaData的方法可以优化一下
     */
    public function getProductMetaData($product_id){
        $meta_arr = [];
        $meta_data = ProductMeta::where('product_id',$product_id)->get();
        if (!$meta_data->isEmpty()){
            foreach ($meta_data as $data){
                $meta_arr = array_merge($meta_arr,[$data['meta_key']=>unserialize($data['meta_value'])]);
            }
        }else{
            return false;
        }
        return $meta_arr;
    }
}
