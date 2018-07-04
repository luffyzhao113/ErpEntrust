<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Route;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;


class EntrustMiddleware
{
    /**
     * 中间件验证
     * @method handle
     * @param $request
     * @param Closure $next
     * @param null $guard
     *
     * @return mixed
     * @throws AuthorizationException
     *
     * @author luffyzhao@vip.126.com
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if($perm = Auth::guard($guard)->user()->can(Route::currentRouteName())){
            return $next($request);
        }
        throw new AuthorizationException('没有权限访问这个接口！');
    }
}
