<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Closure;

use App\Models\OperationLog as Log;

class OperationLog
{
    /**
     * 记录用户操作日志
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = $request->method();
        if (in_array($action, ['POST', 'PUT', 'DELETE'])) {
            if ($request->user()) {
                $operationLog = new Log;
                $operationLog->uid = $request->user()->id;
                $operationLog->url = $request->url();
                $operationLog->data = json_encode($request->all());
                $operationLog->ip = $request->getClientIp();
                $operationLog->save();
            }
        }

        return $next($request);
    }
}
