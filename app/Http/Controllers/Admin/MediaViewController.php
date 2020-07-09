<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-16-016
 * @time 22:42
 */


namespace App\Http\Controllers\Admin;


use App\Entity\Images;
use App\Http\Controllers\Controller;

class MediaViewController extends Controller
{
    public function toMediaView($page){
        $page = $page-1;
        $have_page = intval(ceil(Images::count()/21));
        $images = Images::offset(21*$page)->take(21)->get()->toArray();
        return view('Admin.Media.index')->with('have_page',$have_page)->with("images",$images);
    }
}
