<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-16-016
 * @time 22:42
 */


namespace App\Http\Controllers\Admin;


use App\Entity\Category;
use App\Http\Controllers\Controller;

class CategoryViewController extends Controller
{
    public function toCategoryList(){
        $categories = Category::paginate(10);

        if(!$categories->isEmpty()){
            foreach ($categories as &$category){
                if ($category->parent_id!='0'){
                    $parent = Category::find($category->parent_id);
                    $category->parent_name = $parent->name;
                }else{
                    $category->parent_name = '无分类';
                }
            }
        }
        return view('Admin.Category.category-list')->with('categories',$categories);
    }
    public function toCategoryAdd(){
        $categories = Category::all();
        return view('Admin.Category.category-add')->with('categories',$categories);
    }

    public function toCategoryEdit($category_id){
        $category = Category::find($category_id);
        if ($category->parent_id!='0'){
            $temp = Category::find($category->parent_id);
            $category->parent_name = $temp->name;
        }else{
            $category->parent_name = '未分类';
        }
        $categories = Category::all();
        return view('Admin.Category.category-edit')->with('categories',$categories)->with('category',$category);
    }



}
