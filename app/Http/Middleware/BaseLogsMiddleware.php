<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Modules\BaseLogs\Interfaces;
use Illuminate\Http\Request;
use Route;

class BaseLogsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $user = $request->user();
        if(!$request->isMethod('GET')){
            app(Interfaces::class)->create([
                'uri' => Route::current()->uri,
                'method' => $request->method(),
                'display_name' => __('route.'.$request->method() . ':' . Route::current()->uri),
                'params' => json_encode($request->input()),
                'admin_id' => $user ? $user->id : 0,
                'status_code' => $response->getStatusCode()
            ]);
        }
        return $response;
    }
}
