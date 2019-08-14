<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SetPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->can('set permissions')) {
            return abort(404);
        }
        return $next($request);
    }
}
