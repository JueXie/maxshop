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

class CheckAdmin
{
    public function handle($request,Closure $next){
        $session = $request->session()->get('admin');
        if ($session==null){
            return redirect('/admin/login');
        }
        return $next($request);
    }

}
