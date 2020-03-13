<?php

namespace App\Http\Middleware;

use Closure;
use Response;

class Cors
{
    /**
     * 允许访问的域
     *
     * @var array
     */
    private $domains = array(
    );

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset($request->server()['HTTP_ORIGIN'])) {
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET,PUT,DELETE,POST');
            header('Access-Control-Allow-Headers: Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json, Authorization');
        }

        return $next($request);
    }
}
