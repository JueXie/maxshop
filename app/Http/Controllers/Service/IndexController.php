<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-18-018
 * @time 22:10
 */


namespace App\Http\Controllers\Service;


use App\Entity\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function adminLogin(Request $request){
        $name = $request->get('adminname','');
        $password = $request->get('password','');
        $admin = Admin::where('name','admin')->first();
        if ($admin->password!=$password){
            return redirect('/admin/login');
        }else{
            $request->session()->put('admin','登陆成功');
            return redirect('/admin');
        }
    }
}
