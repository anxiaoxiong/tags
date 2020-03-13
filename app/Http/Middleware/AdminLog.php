<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Closure;

class AdminLog
{
    /**
     * 记录登录用户的操作日志，注册、登录、找回密码等跟用户直接相关的.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $ip = $request->getClientIp();//客户端ip
        //$url = $request->url();//获取当前url
        $url = Route::current()->uri;//获取当前url
        $data = $request->input();//获取所有请求变量
        $res = DB::table('operation_log')
            ->insert([
                    'uid'=>$request->cluid,
                    'url'=>$url,
                    'data'=>json_encode($data),
                    'ip'=>$ip,
                    'created_at'=>time()
                    ]);
        return $response;
    }
}
