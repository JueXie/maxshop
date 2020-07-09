<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-10-010
 * @time 22:39
 */


namespace App\Http\Middleware;
use App\Tool\UUID;
use Closure;
use Illuminate\Support\Facades\Cache;

class MiniProgramCheckToken
{
    public function handle($request,Closure $next){
        $max_token = $request->get('max_token','');
        $user_id = $request->get('user_id','');
        $server_token_cache = Cache::get($user_id,'');
        $server_token = session('max_token','');
        $response =  $next($request);
        if ($server_token==''){
            $response->header('Max-need-login','true');
        }
        if ($server_token_cache ==''){
            $response->header('Max-token-invalid','true');
        }
        if ($max_token!=$server_token_cache||!isset($request->max_token)){
            $arr = ['code'=>'access denied','u_token'=>$max_token,'server_token_cache'=>$server_token_cache];
            return response($arr,403);
        }
        return $response;
    }

}
