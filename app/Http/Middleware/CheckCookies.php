<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckCookies
{

    public function handle($request,Closure $next){
        if(isset($_COOKIE['id'])&& isset($_COOKIE['token'])){
            $key ='str:u:token:'.$_COOKIE['id'];
            //print_r($key);die;
            $token =Redis::hget($key,'web');
            if($_COOKIE['token']==$token){
                $request->attributes->add(['is_login'=>1]);
            }else{
                $request->attributes->add(['is_login'=>0]);
            }
        }else{
            $request->attributes->add(['is_login'=>0]);
        }
        return $next($request);
    }
}