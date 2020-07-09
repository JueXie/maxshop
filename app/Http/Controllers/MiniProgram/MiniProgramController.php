<?php

namespace App\Http\Controllers\MiniProgram;

use App\Entity\User;
use App\Entity\UserMeta;
use App\Tool\UUID;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Validator;
use App\Http\Controllers\Controller;


class MiniProgramController extends Controller
{
    /**
     * 微信小程序登陆
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * 返回一个响应，附带上一个存入session的_token，往后每次登陆都还会通过中间件检查_token。
     */
    public function login(Request $request){
        //数据初始化
        $js_code = $request->get('code','');
        $iv = urldecode($request->get('iv',''));
        $encryptedData = $request->get('encryptedData','');
        $miniprogram = app('wechat.mini_program.default');
        $user_id = $request->get('user_id','');
        //登陆过就直接返回_token
        if ($user_id != ''){
            $user = User::find($user_id);
            $user_id = $user->user_id;
            //生成_token,由中间件认证是否要重新登陆
            $_token = UUID::create('max_token');
            Cache::forever($user_id,$_token);
            session(['max_token'=>$_token]);
            return response(['max_token'=>$_token,'user_id'=>$user_id],200);
        }
        //没有登陆或者退出重新登录的
        $res = $miniprogram->auth->session($js_code);
        //解密错误就返回错误信息
        if (!empty($res['errcode'])){
            return response(array("res"=>$res,"code"=>$js_code),500);
        }

        $userInfo = $miniprogram->encryptor->decryptData($res['session_key'], $iv, $encryptedData);


        $user = User::where('openid',$userInfo['openId'])->first();
        //判断有没有用户
        if (is_null($user)){
            $user = new User();
            $userMeta = new UserMeta();
            $userMeta2 = new UserMeta();
            //保存微信信息
            $user->avatar_url = $userInfo['avatarUrl'];
            $user->openid     = $userInfo['openId'];
            $user->nickname   = $userInfo['nickName'];
            $user->session_key   = $res['session_key'];
            //其他信息默认
            $user->username          = 'created_by_wechatminiprogram';
            $user->password          = 'no_password';
            $user->phone             = 'no_phone';
            $user->email             = 'no_email';
            $user->activition_key    = 'no_activition_key';
            $user->status            = 1;//激活用户
            $user->save();
            //把得到得userInfo保存到userMeta表
            $userMeta->user_id    = $user->user_id;
            $userMeta->slug       =  '微信用户信息';
            $userMeta->meta_key   = 'userInfo';
            $userMeta->meta_value = serialize($userInfo);
            $userMeta->save();
            //默认积分
            $userMeta2->user_id  = $user->user_id;
            $userMeta2->slug      = '积分';
            $userMeta2->meta_key  = 'score';
            $userMeta2->meta_value = serialize(0);
            $userMeta2->save();

            $user_id = $user->user_id;
            //生成_token,由中间件认证是否要重新登陆
            $_token = UUID::create('max_token');
            Cache::forever($user_id,$_token);
            session(['max_token'=>$_token]);
            return response(['max_token'=>$_token,'user_id'=>$user_id],200);
        }
        $user_id = $user->user_id;
        $user->session_key = $res['session_key'];
        $user->save();
        //生成_token,由中间件认证是否要重新登陆
        $_token = UUID::create('max_token');
        Cache::forever($user_id,$_token);
        session(['max_token'=>$_token]);
        return response(['max_token'=>$_token,'user_id'=>$user_id],200);
    }
    public function logout(Request $request){
        $request->session()->forget('max_token');
    }

}
