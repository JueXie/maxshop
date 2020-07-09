<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @data 2020-03-03
 * @time 0:05
 */


namespace App\Http\Controllers\Admin;


use App\Entity\User;
use App\Entity\UserMeta;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\UserController;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function toWelcome(){
        return view('Admin.welcome');
    }


}
