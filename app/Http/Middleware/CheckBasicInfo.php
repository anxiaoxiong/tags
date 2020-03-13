<?php

namespace App\Http\Middleware;

use App\Exceptions\BasicInfoException;
use Closure;

class CheckBasicInfo
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
        $currentUser = $request->user();
        if (!$currentUser->realname || !$currentUser->phone || !$currentUser->email) {
            throw new BasicInfoException('用户名、手机号、邮箱未设置');
        }
        return $next($request);
    }
}
