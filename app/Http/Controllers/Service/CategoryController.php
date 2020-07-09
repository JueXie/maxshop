<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-17-017
 * @time 12:40
 */


namespace App\Http\Controllers\Service;


use App\Entity\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryAdd(Request $request){
        $name = $request->get('name','');
        $parent_id = $request->get('parent_id','');
        $preview_img = $request->get('preview_img','');
        $display = $request->get('display','');

        $category = new Category();
        $category->name = $name;
        $category->parent_id = (int)$parent_id;
        $category->display = $display;
        $category->preview_img = $preview_img;
        $category->save();
        if($parent_id!='0'){
            $parent = Category::find($parent_id);
            $child = $parent->child;
            if (is_null($child)){
                $arr = [$category->category_id];
                $parent->child = serialize($arr);
                $parent->save();
            }else{
                $child = unserialize($child);
                array_push($child,$category->category_id);
                $parent->child = serialize($child);
                $parent->save();
            }
        }


        return response('添加成功',200);
    }

    public function categoryEdit(Request $request,$category_id){
        $name = $request->get('name','');
        $parent_id = $request->get('parent_id','');
        $preview_img = $request->get('preview_img','');
        $display = $request->get('display','');
        $category = Category::find($category_id);
        $origin_parent_id = $category->parent_id;

        $category->name = $name;
        $category->display = $display;
        $category->parent_id = (int)$parent_id;
        $category->preview_img = $preview_img;
        $category->save();
        //新的父类更新child字段
        if($parent_id!='0'){
            $parent = Category::find($parent_id);
            $child = $parent->child;
            if (is_null($child)){
                $arr = [$category->category_id];
                $parent->child = serialize($arr);
                $parent->save();
            }else{
                $child = unserialize($child);
                array_push($child,$category->category_id);
                $parent->child = serialize($child);
                $parent->save();
            }
        }
        //旧的父类更新child
        if ($origin_parent_id!='0'){
            $origin_parent = Category::find($origin_parent_id);
            $origin_child = unserialize($origin_parent->child);
            $key = array_search($category_id,$origin_child);
            unset($origin_child[$key]);
            $origin_parent->child = serialize($origin_child);
            $origin_parent->save();

        }

        return response('修改成功',200);
    }

    public function categoryDelete(Request $request){
        $ids = $request->get('id','');
        if (is_array($ids)){
            foreach ($ids as $id){
                $category = Category::find($id);
                $child = $category->child();
                if (!is_null($child)){
                    $child = unserialize($child);
                    $ids = array_merge($ids,$child);
                }
            }
        }
        Category::destroy($ids);
    }
    //目前仅支持2级分类
    public function getCategories(){
        $categories = Category::where('parent_id','0')->get()->toArray();
        foreach ($categories as &$category) {
            $child_arr = $category["child"];
            $category["child_category"]=[];
            if($child_arr != null){
                $child_arr = unserialize($child_arr);
                foreach ($child_arr as $item){
                    $child_category = Category::find($item)->toArray();
                    array_push($category["child_category"],$child_category);
                }
            }
        }
        return $categories;
    }
}
