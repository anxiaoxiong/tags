<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\RoutePrivilegeModel as RoutePrivilege;
use App\Models\UserPrivilegeModel as UserPrivilege;

class CheckPrivilege
{
   
    /**
     * 错误返回.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private function errorBack($code,$text){
        $arr = [
            'result'=>'fail',
            'response'=>[
                'errorcode'=>$code,
                'errortext'=>$text
                ]
            ];
        if(Session::get("accesstoken")){
            $arr['accesstoken'] = Session::pull("accesstoken");
        }
        return response()->json($arr);
    }

    
    
    /**
     * //检查用户权限.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cluid = $request->cluid;
        //获取请求url
        $curr_url = Route::current();
        $url = $curr_url->uri;
        $method = strtolower($curr_url->methods[0]);
        //获取该权限的信息，如果没有，则权限不存在
        $rPrivilege = new RoutePrivilege;
        $rp = $rPrivilege->where('url',$url)
            ->where('method',$method)
            ->get();
        if(count($rp)<1){
            return $this->errorBack(403,'url不存在');
        }
        $pids = [];
        foreach($rp as $p){
            $pids[] = ''.$p->privilege->id;
        }
        //获取当前用户的所有权限
        $allp = UserPrivilege::where("uid",$cluid)->value('pids');
        $parr = explode(',',$allp);
        if(!array_intersect($pids,$parr)){
            //如果不存在，则表示没有权限，抛出异常
            return $this->errorBack(403,'权限不足');
        }  
        return $next($request);
    }
}
