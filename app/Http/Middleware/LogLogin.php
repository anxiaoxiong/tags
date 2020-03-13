<?php

namespace App\Http\Middleware;

use Jenssegers\Agent\Agent;

use App\Models\LoginLog;
use Closure;

class LogLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $result = $response->original;
        /*if ($result['code'] === 200) {
            $agent = new Agent();

            $log = new LoginLog;
            $log->uid = $result['data']['uid'];
            $log->agent = $agent->browser().'|'.$agent->version($agent->browser());
            $log->system = $agent->platform().'|'.$agent->version($agent->platform());
            $log->version = env('APP_VERSION', 'default');
            $log->ip = $request->getClientIp();
            $log->save();
        }*/

        return $response;
    }
}
