<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ViewUsersCheckLists
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
        if (!Auth::user()->can('view users checklists')) {
            return abort(404);
        }
        return $next($request);
    }
}
