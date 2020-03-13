<?php

namespace App\Http\Middleware;

use App\Exceptions\AbilityException;
use Closure;

class CheckId
{
    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(!preg_match('/^[1-9][0-9]*$/u',$request->id)) {
            throw new AbilityException('传值错误,ID必须是整数且大于0');
		}

        return $next($request);
    }
}
