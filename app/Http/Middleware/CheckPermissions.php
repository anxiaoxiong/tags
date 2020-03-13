<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Exceptions\AbilityException;
use Closure;

class CheckPermissions
{
    const DELIMITER = '|';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        $admin = $request->user();

        if (!is_array($permissions)) {
            $permissions = explode(self::DELIMITER, $permissions);
        }

        if (!$admin->can($permissions) && !$admin->hasRole("admin")) {
            throw new AbilityException('无权限操作');
        }

        return $next($request);
    }
}
