<?php

namespace App\Http\Middleware;

use App\Exceptions\AbilityException;
use Validator;
use Closure;

class CheckPageParam 
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$validator = Validator::make($request->all(), [
                'limit' =>  ['bail','nullable','regex:/^\d+$/'],
				'page' => ['bail','nullable','regex:/^\d+$/'],
				'sort' => 'bail|nullable|alpha_dash',
				'order' => 'bail|nullable|in:desc,asc',
            ],[
                'limit.regex'=>'每页显示条数请传入正整数',
                'page.regex'=>'页数请传入正整数',
                'order.in'=>'排序方式请传入desc或者asc',
                'sort.alpha_dash'=>'排序字段传入格式不正确，请输入字母、下划线或横线',
            ]);
        if ($validator->fails()) {
            $message = $validator->errors();
            throw new AbilityException($message->first());
        }

        return $next($request);
    }
}
